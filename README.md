# Students-Courses-API

> API demonstrating an implementation of MANY-TO-MANY relationship between students and courses with Laravel


### Clone

- Clone the repository using `git clone https://github.com/tosinibrahim96/User-Courses-API.git`
- Create a `.env` file in the root folder and copy everything from `.env-sample` into it
- Fill the `.env` values with your Database details as required


### Setup

- Download WAMP or XAMPP to manage APACHE, MYSQL and PhpMyAdmin. This also installs PHP by default. You can follow [this ](https://youtu.be/h6DEDm7C37A)tutorial
- Download and install [composer ](https://getcomposer.org/)globally on your system

> install all project dependencies and generate application key

```shell
$ composer install
$ php artisan key:generate
```
> migrate all tables and seed required data into the database 

```shell
$ php artisan migrate:fresh --seed
```
> generate a JWT_SECRET value in your `.env` file. This will be used for JWT authentication

```shell
$ php artisan jwt:secret
```
> start your Apache server and MySQL on WAMP or XAMPP interface
> generate a JWT_SECRET value in your `.env` file. This will be used for JWT authentication

```shell
$ php artisan jwt:secret
```
> serve your project using the default laravel PORT or manually specify a PORT

```shell
$ php artisan serve (Default PORT)
$ php artisan serve --port={PORT_NUMBER} (setting a PORT manually)
```


### Available Endpoints

| Endpoint                                | Request Type | Payload                                                            |
| --------------------------------------- | ------------ | ------------------------------------------------------------------ |
| {BASE_URL}/api/v1/auth/register         | POST         | name,email,password                                                |
| {BASE_URL}/api/v1/auth/login            | POST         | email,password                                                     |
| {BASE_URL}/api/v1/auth/logout           | POST         | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses               | POST         | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses               | GET          | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/courses/export        | GET          | Bearer {Token}                                                     |
| {BASE_URL}/api/v1/user/register-courses | POST         | Bearer {Token}, courses(Array containing course(s) id e.g [1,4,5]) |


### License

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © <a href="https://tosinibrahim96.github.io/Resume/" target="_blank">Ibrahim Alausa</a>.
