# RideCrafters

## Description

RideCrafters is the backend for a ride-hailing application. It provides the necessary API endpoints for managing trips, locations, and reservations. This project is designed to handle all the server-side logic and database interactions for the ride-hailing app, allowing the frontend to focus on user interactions.

## Technologies

The project is built using the following technologies:
- Laravel: A PHP framework for building web applications
- sqlite: A lightweight database engine for storing application data
- Composer: A package manager for PHP
- Sanctum: A Laravel package for API authentication

## Installation

Follow these steps to install the project:

1. Clone the repository: `git clone https://github.com/abdelounim-dev/ride_crafters.git`
2. Navigate to the project directory: `cd ride_crafters`
3. Install dependencies: `composer install`
4. Set up the environment: `cp .env.example .env && php artisan key:generate`
5. Run migrations and seeders: `php artisan migrate --seed`

## Usage

Here's how to use the project:

- Start the server: `php artisan serve`
- Access the application: Open `http://localhost:8000` in a web browser
- Using the API: Send a `GET` request to `http://localhost:8000/api/trips` to retrieve all trips
