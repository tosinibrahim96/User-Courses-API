# User-Courses-API

Simple API to demonstrate how to implement features MANY-TO-MANY relationship with relational databases

## Getting Started

### Use these steps to create a local copy of the project to get started

- Clone the repository using `git clone https://alawishinspires@bitbucket.org/alawishinspires/seamlesshr-test.git`
- Create a `.env` file in the root folder and copy everything from .env-sample into it
- Fill the `.env` values with your Database details as required

## Prerequisites

### Everything we need for a convinient development experience

- Download WAMP or XAMPP to manage APACHE, MYSQL and PhpMyAdmin. This also installs PHP by default. You can follow [this ](https://youtu.be/h6DEDm7C37A)tutorial
- Download and install [composer ](https://getcomposer.org/)globally on your system

## Installations/Configuration

- Run `composer install` to use project dependencies
- run `php artisan key:generate` set your application key
- Run `php artisan migrate:fresh --seed` to migrate all tables and seed required data into the database
- Run `php artisan jwt:secret` to generate a JWT_SECRET value in your `.env` file. This will be used for JWT authentication
- Start your Apache server and MySQL on WAMP or XAMPP interface
- run `php artisan serve` to serve your project on the server at http://localhost:8000

### Note: It's possible another application is using PORT 8000, use `php artisan serve --port={PORT_NUMBER}` to serve the application on another port.

## Available Endpoints

| Endpoint                                | Request Type | Payload                                                            |
| --------------------------------------- | ------------ | ------------------------------------------------------------------ |
| {BASE_URL}/api/v1/auth/register         | POST         | name,email,password                                                |
| {BASE_URL}/api/v1/auth/login            | POST         | email,password                                                     |
| {BASE_URL}/api/v1/auth/logout           | POST         | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses               | POST         | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses               | GET          | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses/export        | GET          | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/user/register-courses | POST         | Bearer {Token}, courses(Array containing course(s) id e.g [1,4,5]) |

## Author

- **Ibrahim Alausa** - [LinkedIn](https://www.linkedin.com/in/ibrahim-alausa-624a47140/)
