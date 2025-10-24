#!/bin/bash

# Deployment script for Bina Adult Care

# Exit on error
set -e

# Configuration
REPO_URL="git@github.com:yourusername/bina-adult-care.git"
DEPLOY_PATH="/var/www/bina-adult-care"
BACKUP_PATH="/var/backups/bina-adult-care"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Log function
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

error() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR: $1${NC}"
}

warn() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}"
}

# Check if running as root
if [[ $EUID -ne 0 ]]; then
   error "This script must be run as root"
   exit 1
fi

# Create backup directory if it doesn't exist
mkdir -p "$BACKUP_PATH"

# Backup database
log "Creating database backup..."
if ! mysqldump -u root bina_adult_care > "$BACKUP_PATH/db_backup_$TIMESTAMP.sql"; then
    error "Database backup failed"
    exit 1
fi
gzip "$BACKUP_PATH/db_backup_$TIMESTAMP.sql"

# Put application in maintenance mode
log "Enabling maintenance mode..."
cd "$DEPLOY_PATH/backend"
php artisan down

# Pull latest code
log "Pulling latest code..."
git pull origin main

# Install/update dependencies
log "Installing backend dependencies..."
cd "$DEPLOY_PATH/backend"
composer install --no-dev --optimize-autoloader

# Clear caches
log "Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run database migrations
log "Running database migrations..."
php artisan migrate --force

# Rebuild caches
log "Rebuilding cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Update frontend configuration if needed
if [ -f "$DEPLOY_PATH/frontend/js/config.js" ]; then
    log "Updating frontend configuration..."
    # You might want to use sed or envsubst to replace values
    # sed -i "s|baseUrl:.*|baseUrl: '$API_URL',|" "$DEPLOY_PATH/frontend/js/config.js"
fi

# Set proper permissions
log "Setting file permissions..."
chown -R www-data:www-data "$DEPLOY_PATH"
find "$DEPLOY_PATH" -type f -exec chmod 644 {} \;
find "$DEPLOY_PATH" -type d -exec chmod 755 {} \;
chmod -R 775 "$DEPLOY_PATH/backend/storage"

# Restart services if needed
log "Restarting services..."
systemctl restart php8.1-fpm
systemctl restart nginx

# Run health check
log "Running health check..."
HEALTH_CHECK=$(curl -s http://localhost/api/health)
if [[ $(echo "$HEALTH_CHECK" | jq -r '.status') != "healthy" ]]; then
    error "Health check failed. Response: $HEALTH_CHECK"
    # Optionally revert to previous version here
    exit 1
fi

# Bring application back online
log "Disabling maintenance mode..."
php artisan up

log "Deployment completed successfully!"

# Clean up old backups (keep last 7 days)
find "$BACKUP_PATH" -name "db_backup_*.sql.gz" -mtime +7 -delete

exit 0