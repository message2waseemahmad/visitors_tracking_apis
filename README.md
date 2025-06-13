# 📌 Visitors Tracking System API (Laravel + Docker)

This Laravel-based REST API allows you to track and manage visitors efficiently. The project is set up to run with Docker for consistent development and deployment environments, and also supports WAMP/XAMPP for local setups.

---

## 🚀 Features

- Laravel 10+ backend
- Dockerized services:
  - PHP (Laravel)
  - MySQL 8
  - Redis
  - phpMyAdmin
- Postman collection for testing API endpoints
- Supports both Docker and WAMP/XAMPP environments

---

## ⚠️ Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- WSL 2 (on Windows)
- Git
- Composer (optional if not using Docker)

---

## 🌐 Getting Started with Docker

### 1. Clone the Repository

```bash
git clone https://github.com/message2waseem/visitors_trackingsystem_apis.git
cd visitors_trackingsystem_apis
```

### 2. Copy and Configure Environment File

```bash
cp .env.example .env
```

Update the `.env` file as needed based on your environment:

- For Docker: `DB_HOST=mysql`
- For WAMP/XAMPP: `DB_HOST=127.0.0.1`

> ❌ Do not commit `.env` to Git. `.env.example` is provided for reference.

### 3. Start the Containers

```bash
docker-compose up -d
```

### 4. Install Laravel Dependencies

```bash
docker exec -it laravel-app bash
composer install
php artisan key:generate
php artisan migrate
```

### 5. Access Services

- **Laravel API**: [http://localhost:8000](http://localhost:8000)
- **phpMyAdmin**: [http://localhost:8080](http://localhost:8080)
  - Server: `mysql`
  - Username: `root`
  - Password: `root`

---

## 🔢 Environment Configuration

### Docker Environment Settings (`.env`)

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=visitors_trackingsystem
DB_USERNAME=root
DB_PASSWORD=root
```

> ✅ Use this when running the app inside Docker.

### WAMP/XAMPP Environment Settings (`.env`)

If running the app locally on WAMP/XAMPP, update your `.env` like this:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=visitors_trackingsystem
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ Make sure the database `visitors_trackingsystem` exists in your MySQL server. 💡 Also run `composer update` to install all dependencies if you are not using Docker.

---

## 🧲 Running API Tests

To run the built-in Laravel feature tests for your API, use:

```bash
php artisan test
```

This will execute all test cases located in the `tests/` directory.

---

## 🔢 Postman Collection

You can find the full Postman collection in:

```bash
/postman/Visitors Tracking system.postman_collection.json
```

### How to Use:

1. Open Postman
2. Click **Import** > **Upload Files**
3. Select the file above
4. Use the collection to test endpoints at [http://localhost:8000](http://localhost:8000)

---

## 📅 Useful Docker Commands

```bash
# Stop and remove all containers and volumes
docker-compose down -v

# Start containers again
docker-compose up -d

# Access the Laravel app container
docker exec -it laravel-app bash
```

---

## ⚡ Troubleshooting

| Issue                             | Fix                                                             |
| --------------------------------- | --------------------------------------------------------------- |
| phpMyAdmin can't connect to MySQL | Use `mysql` as the server name, not `localhost`                 |
| Laravel can't connect to MySQL    | Ensure DB\_HOST in `.env` is set to `mysql` in Docker setup     |
| Migrations fail on startup        | Ensure MySQL is ready; try waiting a few seconds before running |
| Port conflict                     | Change the ports in `docker-compose.yml`                        |

---

## 📚 Project Structure

```
visitors_trackingsystem_apis/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── docker-compose.yml
├── Dockerfile
├── postman/
│   └── Visitors Tracking system.postman_collection.json
├── public/
├── routes/
├── .env.example
└── README.md
```

---


