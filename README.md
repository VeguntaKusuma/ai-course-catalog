# AI Course Catalog

AI Course Catalog is a full-stack Laravel application designed to manage courses and allow users to browse and enroll seamlessly.

## Live Demo

https://your-live-url.com

## GitHub Repository

https://github.com/your-username/ai-course-catalog

## Features

* Admin authentication (custom implementation without Laravel Breeze)
* Course management (Create, Read, Update, Delete)
* Course image upload
* Course listing with pagination
* Course search functionality
* Course detail view
* Enrollment system using modal form
* Frontend and backend validation

## Tech Stack

* Backend: PHP, Laravel
* Frontend: HTML, CSS, Bootstrap, JavaScript
* Database: MySQL
* Tools: Git, GitHub, Cursor AI

## Installation

### Clone the repository

```bash
git clone https://github.com/your-username/ai-course-catalog.git
cd ai-course-catalog
```

### Install dependencies

```bash
composer install
```

### Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

### Configure database

Update the `.env` file:

```env
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

### Run migrations and serve

```bash
php artisan migrate
php artisan storage:link
php artisan serve
```

## Project Structure

```
ai-course-catalog/
├── app/
│   ├── Http/
│   ├── Models/
├── database/
│   ├── migrations/
├── resources/
│   ├── views/
├── routes/
│   └── web.php
```

## Admin Access

Email: admin@gmail.com
Password: kusuma123

## Deployment

This project can be deployed on platforms like Render or Railway.

## About the Project

This project demonstrates practical implementation of Laravel concepts such as MVC architecture, CRUD operations, validation, relationships, and basic authentication.

## Author

Kusumasri Vegunta

