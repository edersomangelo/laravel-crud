<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Sample crud project

## Requirements

    PHP >= 7.0.0
    OpenSSL PHP Extension
    PDO PHP Extension
    Mbstring PHP Extension
    Tokenizer PHP Extension
    XML PHP Extension
    Composer

## Installation steps
I will not ilustrate how run or configure the web server  
All the following steps must be executed on the project main directory  

##### 1. Installing project dependencies
    composer install
    npm install
##### 2.Configuring the application
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link
>Configure the data base on the .env file

##### 3. Give write permission to the user that you are using to run your web server
    chown www-data storage -R
    chown www-data bootstrap/cache
##### 4. Setting up the database
    php artisan migrate
    php artisan db:seed --class=DevelopmentSeeder
#####Have fun

##
https://laravel.com/docs/5.5