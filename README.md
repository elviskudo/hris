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

## Open the application

1. Open your web browser then go to 0.0.0.0:8080
