<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Docker installation

1. Install Docker on your machine if you haven't already.
2. Open a terminal and navigate to the project directory.
3. Run the command `docker-compose up -d` to start the Docker containers in detached mode
4. Open your web browser then go to 0.0.0.0:8000

## Clone the app from github repository

1. Open a terminal
2. Navigate to the directory where you want to clone the app
3. Run the command `git clone https://github.com/elviskudo/hris`
4. Navigate to the cloned directory `cd hris`
5. Run the command `composer install` to install the dependencies
6. Run the command `php artisan key:generate` to generate the app key

## Aiven PostgreSQL integration

1. Create a PostgreSQL database and update the `.env` file with your database credentials.
2. Copy your credentials pem file to `public/storage/certs/aiven-ca-cert.pem`
3. Run the command `php artisan migrate` to migrate the database schema.
4. Run the command `php artisan db:seed` to seed the database with some dummy data

## Vuejs

1. Make sure you have nodejs version 20.2.0
2. Run the command `npm install` to install the frontend dependencies
3. Run the command `npm install vue@latest vue-loader@latest` to install latest vuejs
4. Run the command `npm install --save-dev @vitejs/plugin-vue` to install the vite plugin-vue
5. Run the command `npm install -D tailwindcss` to install the tailwindcss
6. Run the command `npx tailwindcss init` to create tailwindcss initial
7. Run the command `npm run dev` to start the Vue development server

## Open the application

1. Open your web browser then go to 0.0.0.0:8080
