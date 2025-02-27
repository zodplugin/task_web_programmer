<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Installation Guide

## Prerequisites
Before you begin, ensure you have the following installed on your machine:
- PHP (>=8.0)
- Composer
- Node.js & NPM (optional, for frontend assets)
- MySQL or any supported database

## Installation Steps

### 1. Clone the Repository
```sh
git clone https://github.com/zodplugin/task_web_programmer
cd task_web_programmer
```

### 2. Install Dependencies
```sh
composer install
```

### 3. Set Up Environment File
```sh
cp .env.example .env
```
Modify `.env` file with your database credentials and application settings.

### 4. Generate Application Key
```sh
php artisan key:generate
```

### 5. Run Database Migrations
```sh
php artisan migrate
```

### 6. Seed the Database (Optional)
```sh
php artisan db:seed
```

### 7. Serve the Application
```sh
php artisan serve
```
Access the application at `http://127.0.0.1:8000`

### 8. (Optional) Compile Frontend Assets
```sh
npm install && npm run dev
```

## Additional Commands
To run the Laravel queue worker:
```sh
php artisan queue:work
```

To clear cache:
```sh
php artisan cache:clear
```

For more commands, check Laravel’s official documentation: [Laravel Docs](https://laravel.com/docs).

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

