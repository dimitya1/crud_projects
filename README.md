# URL Shortener

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This project is a platform where users can create projecs and labels linked to the project and manage them.
	
## Technologies
Project is created with:
* PHP: 7.4.8
* Laravel: 8
* Docker
* Bootstrap: 4.5
* MySQL
	
## Setup
To run this project, you need an empty Laravel project.
Use docker command
```
docker run --rm --interactive --tty --volume path_to_your_PhpstormProjects_folder:/app composer create-project --prefer-dist laravel/laravel project_name
```
or
check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x).

Clone the repository
```
git clone https://github.com/dimitya1/crud_projects
```
Copy the example env file and make the required configuration changes in the .env file

Build and run docker containers
```
docker-compose build
docker-compose up -d
```
or
use IDE to build and run docker containers

Install all the dependencies using composer in php-fpm container
```
composer install
```
In php-fpm container run migrations and seed database
```
php artisan migrate --seed
```
#### You can now access the server!
