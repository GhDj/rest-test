# Laravel REST API with Docker

A RESTful API built with Laravel 10 and Docker, featuring user authentication and country relationships.

## Features

- User Authentication with Laravel Sanctum
- CRUD operations for Users
- Country and User relationship
- Docker containerization
- Unit Tests
- Protected API endpoints
- Database migrations and seeders

## Prerequisites

- Docker Desktop
- Git
- Postman (for testing APIs)

## Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/GhDj/rest-test.git
cd rest-test
```

2. Copy the environment file:
```bash
cp .env.example .env
```

3. Build and start the Docker containers:
```bash
docker compose up -d --build
```

4. Install dependencies:
```bash
docker compose exec app composer install
```

5. Generate application key:
```bash
docker compose exec app php artisan key:generate
```

6. Run the database migrations:
```bash
docker compose exec app php artisan migrate
```

7. Run all seeders:
```bash
docker compose exec app php artisan db:seed
```

The application should now be running at `http://localhost:8000`

## API Endpoints

### Public Endpoints

- **POST** `/api/register`
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "country_id": 1
  }
  ```

- **POST** `/api/login`
  ```json
  {
    "email": "john@example.com",
    "password": "password123"
  }
  ```

### Protected Endpoints
(Require Bearer Token Authentication)

- **GET** `/api/users` - List all users
- **GET** `/api/users/{id}` - Get specific user
- **POST** `/api/users` - Create new user
- **PUT** `/api/users/{id}` - Update user
- **DELETE** `/api/users/{id}` - Delete user
- **POST** `/api/logout` - Logout user
- **GET** `/api/profile` - Get current user profile

## Testing

1. Set up testing environment:
```bash
docker compose exec app cp .env .env.testing
```

2. Create test database:
```bash
docker compose exec db mysql -uroot -p${DB_PASSWORD} -e "CREATE DATABASE IF NOT EXISTS laravel_testing;"
```

3. Run tests:
```bash
docker compose exec app php artisan test
```

## Postman Testing Examples

### Register User
```
POST http://localhost:8000/api/register
Headers:
  Accept: application/json
  Content-Type: application/json

Body:
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "country_id": 1
}
```

### Login
```
POST http://localhost:8000/api/login
Headers:
  Accept: application/json
  Content-Type: application/json

Body:
{
    "email": "john@example.com",
    "password": "password123"
}
```

### List Users (Protected Route)
```
GET http://localhost:8000/api/users
Headers:
  Accept: application/json
  Authorization: Bearer {your_token}
```

## Directory Structure

```
├── app
│   ├── Http
│   │   └── Controllers
│   │       └── API
│   │           ├── AuthController.php
│   │           └── UserController.php
│   └── Models
│       ├── User.php
│       └── Country.php
├── database
│   ├── factories
│   │   ├── UserFactory.php
│   │   └── CountryFactory.php
│   └── migrations
├── tests
│   └── Feature
│       └── API
│           ├── AuthControllerTest.php
│           └── UserControllerTest.php
├── docker
│   └── nginx
│       └── conf.d
│           └── app.conf
├── docker-compose.yml
└── Dockerfile
```

## Stopping the Application

To stop the Docker containers:
```bash
docker compose down
```

## Troubleshooting

1. **Permission Issues**:
   If you encounter permission issues, run:
   ```bash
   docker compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

2. **Database Connection Issues**:
   Make sure your .env file has the correct database configuration:
   ```
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

3. **Port Conflicts**:
   If port 8000 is already in use, modify the port mapping in docker-compose.yml

