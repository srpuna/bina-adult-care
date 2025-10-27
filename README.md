# Bina Adult Care Website 
Demo site: https://binaadultcare.infinityfreeapp.com/?i=1

This is a modern web application for Bina Adult Care, consisting of a static frontend and Laravel backend API.

## Project Structure

- `/frontend` - Static HTML/CSS/JS website
- `/backend` - Laravel API backend
- `/docs` - Additional documentation

## Quick Start

1. Set up the backend:
   ```bash
   cd backend
   composer install
   cp .env.example .env
   # Configure database in .env
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   php artisan serve
   ```

2. Set up the frontend:
   ```bash
   cd frontend
   # Serve using any static file server, e.g.:
   php -S localhost:3000
   # or
   python -m http.server 3000
   ```

3. Access the website at `http://localhost:3000`
   The admin dashboard will be at `http://localhost:3000/admin`

## Features

- Modern, responsive design
- Service listings
- Contact form
- Content management system
- Admin dashboard
- RESTful API

## Development

See individual READMEs in `/frontend` and `/backend` directories for detailed development instructions.

## License

All rights reserved. This is proprietary software.
