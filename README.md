<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

#Truck Booking API

This is a Laravel-based API that handles user authentication, order creation, and management for a mobile truck booking app. It allows users to register, log in, and create truck booking requests. The API utilizes **Sanctum** for authentication, **MySQL** for the database, and is ready to handle orders and user profiles.

## Features

- **User Registration & Authentication** using Laravel Sanctum
- **Order Management**: Users can create, view, and update orders
- **User Profile**: Users can view and update their profiles

## Prerequisites

Before installing the application, ensure you have the following installed:

- **PHP 8.3+**
- **Composer** (Dependency Management)
- **MySQL** (or MariaDB)
- **Node.js & NPM** (for compiling assets, if necessary)

## Installation

Follow these steps to set up the project locally:

### 1. Clone the Repository
```
git clone https://github.com/yourusername/truck-booking-api.git
cd truck-booking-api
```


### 2. Install PHP dependencies using Composer
```composer install```

### If you have front-end assets to compile, install JavaScript dependencies
```npm install```

### 3. Copy the example .env file to .env
```cp .env.example .env```

### 4. Generate the application key (if not set in the .env file)
```php artisan key:generate```

### 5. Run database migrations to create the necessary tables
```php artisan migrate```

### Optionally, run the seeders to populate the database with default data
```php artisan db:seed```

### 6. Install Sanctum for API authentication
```php artisan sanctum:install```

### 7. Start the Laravel development server
```php artisan serve```


## 8. Some useful commands:
```
### Clear cache
php artisan cache:clear

### Run migrations
php artisan migrate

### Generate the application key (if not already done)
php artisan key:generate

### Start the queue worker (if needed)
php artisan queue:work
```

#API Endpoints

## Authentication Routes

### 1. Register a new user (POST /register)
```
curl -X POST http://localhost:8000/register \
     -d "name=John Doe&email=john@example.com&password=secret&phone=1234567890"
```

### 2. Login to get an authentication token (POST /login)
```curl -X POST http://localhost:8000/login \
     -d "email=john@example.com&password=secret"
```
# Protected Routes (Requires Authentication via Sanctum)

### 3. Create a new truck booking order (POST /orders)
```curl -X POST http://localhost:8000/orders \
     -H "Authorization: Bearer <your_api_token>" \
     -d "pickup_address=123 Main St&delivery_address=456 Elm St&pickup_time=2024-12-20 08:00:00&delivery_time=2024-12-20 18:00:00&weight=1500&size=large"
```
### 4. View all orders created by the authenticated user (GET /orders)
```curl -X GET http://localhost:8000/orders \
     -H "Authorization: Bearer <your_api_token>"
```
### 5. View a specific order by ID (GET /orders/{id})
```curl -X GET http://localhost:8000/orders/1 \
     -H "Authorization: Bearer <your_api_token>"
```
### 6. View the authenticated user's profile (GET /profile)
```curl -X GET http://localhost:8000/profile \
     -H "Authorization: Bearer <your_api_token>"
```
### 7. Update the authenticated user's profile (PUT /profile)
```curl -X PUT http://localhost:8000/profile \
     -H "Authorization: Bearer <your_api_token>" \
     -d "name=John Doe&email=john.doe@example.com&phone=9876543210"
```
