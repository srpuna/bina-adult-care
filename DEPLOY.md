# Deployment Guide

This guide provides instructions for deploying the Bina Adult Care website to a production environment.

## Prerequisites

1. Web server (Apache or Nginx)
2. PHP 8.1 or higher
3. MySQL 5.7 or higher
4. Composer
5. Node.js 14+ (for building assets)

## Backend Setup

1. Clone the repository:
```bash
git clone https://github.com/yourusername/bina-adult-care.git
cd bina-adult-care
```

2. Install PHP dependencies:
```bash
cd backend
composer install --no-dev
```

3. Configure environment variables:
```bash
cp .env.example .env
```
Edit `.env` with your production settings:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_HOST=your_db_host
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Create and optimize autoloader:
```bash
composer dump-autoload -o
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Set up file storage:
```bash
php artisan storage:link
```

8. Cache configuration and routes:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Frontend Setup

1. Update the API configuration in `frontend/js/config.js`:
```javascript
const config = {
    api: {
        baseUrl: 'https://your-domain.com/api',
        // ... other settings
    }
};
```

2. Set up web server configuration:

### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.html$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.html [L]
</IfModule>

# Security headers
<IfModule mod_headers.c>
    Header set X-XSS-Protection "1; mode=block"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-Content-Type-Options "nosniff"
    Header set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Enable GZIP compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
    AddOutputFilterByType DEFLATE application/json
</IfModule>

# Set caching headers
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/x-icon "access plus 1 year"
    ExpiresDefault "access plus 2 days"
</IfModule>
```

### Nginx (nginx.conf)
```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com;

    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;

    root /path/to/bina-adult-care/frontend;
    index index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 10240;
    gzip_proxied expired no-cache no-store private auth;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml application/json;
    gzip_disable "MSIE [1-6]\.";

    location / {
        try_files $uri $uri/ /index.html;
        expires 1h;
        add_header Cache-Control "public, no-transform";
    }

    location /api {
        proxy_pass http://localhost:8000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    location ~* \.(jpg|jpeg|png|webp|gif|ico)$ {
        expires 1y;
        add_header Cache-Control "public, no-transform";
    }

    location ~* \.(css|js)$ {
        expires 1M;
        add_header Cache-Control "public, no-transform";
    }
}
```

## SSL Certificate

1. Install Certbot for SSL:
```bash
sudo apt install certbot
```

2. Generate SSL certificate:
```bash
sudo certbot --nginx -d your-domain.com
```

## Maintenance and Updates

1. Put the application in maintenance mode during updates:
```bash
php artisan down
```

2. Update the code and dependencies:
```bash
git pull origin main
composer install --no-dev
php artisan migrate
```

3. Clear and rebuild caches:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Bring the application back online:
```bash
php artisan up
```

## Monitoring and Logging

1. Configure Laravel logging in `.env`:
```env
LOG_CHANNEL=daily
LOG_LEVEL=error
```

2. Set up log rotation in `/etc/logrotate.d/bina-adult-care`:
```
/path/to/bina-adult-care/backend/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
}
```

## Backup Strategy

1. Set up database backups:
```bash
# Create backup script
#!/bin/bash
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/path/to/backups"
mysqldump -u your_db_user -p your_db_name > "$BACKUP_DIR/db_backup_$TIMESTAMP.sql"
gzip "$BACKUP_DIR/db_backup_$TIMESTAMP.sql"
```

2. Schedule backups in crontab:
```bash
0 2 * * * /path/to/backup-script.sh
```

## Security Considerations

1. Set proper file permissions:
```bash
sudo chown -R www-data:www-data /path/to/bina-adult-care
sudo find /path/to/bina-adult-care -type f -exec chmod 644 {} \;
sudo find /path/to/bina-adult-care -type d -exec chmod 755 {} \;
sudo chmod -R 775 /path/to/bina-adult-care/backend/storage
```

2. Configure PHP settings in php.ini:
```ini
display_errors = Off
log_errors = On
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
max_execution_time = 30
max_input_time = 60
memory_limit = 128M
post_max_size = 20M
upload_max_filesize = 10M
```

## Performance Optimization

1. Install and configure PHP OPcache:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
opcache.fast_shutdown=1
opcache.enable_cli=1
```

2. Configure MySQL for production:
```ini
innodb_buffer_pool_size = 1G
innodb_flush_log_at_trx_commit = 2
innodb_log_file_size = 256M
```

3. Set up Redis for caching (optional):
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Troubleshooting

Common issues and solutions:

1. 502 Bad Gateway
- Check PHP-FPM is running: `systemctl status php8.1-fpm`
- Check Nginx error logs: `tail -f /var/log/nginx/error.log`

2. Database Connection Issues
- Verify credentials in `.env`
- Check MySQL is running: `systemctl status mysql`
- Verify network connectivity: `telnet db_host 3306`

3. File Permission Issues
- Run the permission commands from the Security section
- Check PHP process owner: `ps aux | grep php`

4. SSL Certificate Issues
- Verify certificate renewal: `certbot certificates`
- Check SSL configuration: `nginx -t`