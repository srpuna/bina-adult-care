# Bina Adult Care - Backend

This is the Laravel backend for the Bina Adult Care website. It provides API endpoints for managing services, content, and contact form submissions.

## Features

- RESTful API endpoints for managing services and content
- Contact form submission handling
- Admin authentication
- Content management system backend
- Database seeding for initial content

## Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 5.7 or higher
- phpMyAdmin (optional but recommended)

### Installation

1. Clone the repository and navigate to the backend directory:

```bash
cd backend
```

2. Install PHP dependencies:

```bash
composer install
```

3. Set up the environment:

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. Configure database in `.env`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bina_adult_care
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Create the database in phpMyAdmin or MySQL:

```sql
CREATE DATABASE bina_adult_care;
```

6. Run migrations and seed the database:

```bash
php artisan migrate
php artisan db:seed
```

7. Start the development server:

```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`.

## API Endpoints

### Public Endpoints

- `GET /api/services` - List all services
- `GET /api/content` - Get all content
- `GET /api/content?page=home` - Get content for specific page
- `POST /api/contact` - Submit contact form

### Admin Endpoints

- `POST /api/services` - Create new service
- `PUT /api/services/{id}` - Update service
- `DELETE /api/services/{id}` - Delete service
- `POST /api/content/upsert` - Update page content

## Sample Admin Credentials

Email: admin@binaadultcare.com
Password: (set during admin user creation)

## Frontend Integration

The static frontend can fetch content using these endpoints. Example fetch call:

```javascript
// Fetch services
fetch('http://localhost:8000/api/services')
  .then(response => response.json())
  .then(services => {
    // Update UI with services
  });

// Submit contact form
fetch('http://localhost:8000/api/contact', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    name: 'John Doe',
    email: 'john@example.com',
    phone: '123-456-7890',
    message: 'Hello, I would like to learn more about your services.',
  }),
})
  .then(response => response.json())
  .then(data => {
    // Handle response
  });
```

## Contributing

Please read the contribution guide before submitting pull requests.

## License

This project is proprietary software. All rights reserved.
