
<h1 align="center">Backend Task</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/kemox5/reach-task?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/kemox5/reach-task?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/kemox5/reach-task?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/kemox5/reach-task?color=56BEB8">

  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/kemox5/reach-task?color=56BEB8" /> -->

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/kemox5/reach-task?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/kemox5/reach-task?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  Reach Task 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#features">Features</a> &#xa0; | &#xa0;
  <a href="#technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#starting">Starting</a> &#xa0; | &#xa0;
  <a href="https://github.com/kemox5" target="_blank">Author</a>
</p>

<br>

## Features ##

- Ads module "Modules/Ads"
  - Feature tests "Modules/Ads/tests/Feature"
  - Migrations, factories and seeders "Modules/Ads/database"
  - Routes "Modules/Ads/routes/api.php"
  - Controllers "Modules/Ads/app/Http/Controllers"
  - Requests and validation rules "Modules/Ads/app/Http/Requests"
  - Using ads filter trait "Modules/Ads/app/Traits/AdFilters.php" 
  - Scheduled mail reminder using job "Modules/Ads/app/Jobs/SendReminderMailToAdvertisers.php" and registered in "Modules/Ads/app/Providers/AdsServiceProvider.php"

<br>

## Technologies ##

The following tools were used in this project:

- [laravel/framework 9.19](https://laravel.com/docs/9.x)


<br>

## Requirements ##

- php 8.1
- composer v2
- sqlite or any other relational dbms


<br>

## Postman collection ##

- https://www.getpostman.com/collections/c25817ee3e279aae70a3

<br>

## Starting ##

```bash
# Clone this project
$ git clone https://github.com/kemox5/reach-task.git

# Access
$ cd reach-task

# Directory Permissions
$ chmod -R 777 storage bootstrap/cache

# Install dependencies
$ composer install

# Copy .env
$ php -r "file_exists('.env') || copy('.env.example', '.env');"

# Generate key
$ php artisan key:generate

# Create Database
$ mkdir -p database
$ touch database/database.sqlite

# update .env file database section with
  DB_CONNECTION=sqlite
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=project_folder/database/database.sqlite

# migrate database
$ php artisan migrate

# seed database
$ php artisan db:seed

# Execute tests (Unit and Feature tests) via PHPUnit
$ vendor/bin/phpunit

# Run the project
$ php artisan serv

# The server will initialize in the <http://127.0.0.1:8000>
```


<a href="#top">Back to top</a>
