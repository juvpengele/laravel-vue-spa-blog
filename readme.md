# Laravel and Vue Single Page Application Blog

This application can be used as **starter kit** if you want to get started building an single page application with **Laravel** 
and **VueJS**. 
This is a blog using feature like administration, creating and editing posts, commenting, searching posts and many other feature which can be found in most web applications.

## Technologies

### Frontend

* [VueJS](https://fr.vuejs.org/index.html) - A JavaScript framework for building great user interfaces.
* [Bootstrap 4](https://getbootstrap.com) - Bootstrap is the most used CSS framework.
* [Vuex](https://getbootstrap.com) - A state management library for VueJS applications and serves as a central
store for the application.

### Backend

* PHP 7.2
* SQLite3 for development and MySQL for production.
* PHPUnit for unit tests.
* [Laravel](http://www.laravel.com) - A PHP Full stack framework
* [Tymon/Jwt-auth](https://jwt-auth.readthedocs.io/en/develop/) - A library used in laravel for Json Web Token authentication

## Features

* CRUD (create / read / update / delete) on posts
* CRUD (create / read / update / delete ) on post categories
* Image upload for post cover
* Creating comments on post page
* Pagination on posts listing
* Searching on posts
* Authentication for the admin
* Application ready for production

## Prerequisites

* PHP 7.2
* SQLite3
* Git
* Composer

## Getting Started

* Clone the project from Github

          $ git clone https://github.com/juvpengele/laravel-vue-spa-blog
          $ cd laravel-vue-spa-blog
          laravel-vue-spa-blog$

* Install the packages for laravel:

         laravel-vue-spa-blog$ composer install

* Create the database:

          laravel-vue-spa-blog$ touch database/database.sqlite
          
* Create the .env file :

          laravel-vue-spa-blog$ cp .env.example .env
        
* Generate the encryption key for Laravel :

          laravel-vue-spa-blog$ php artisan key:generate
        
* Add database information :

          laravel-vue-spa-blog$ vim .env
        
* Change the DB_CONNECTION to put sqlite :

          DB_CONNECTION=sqlite        

* Load sample records:

          laravel-vue-spa-blog$ php artisan migrate --seed

* Run the Laravel Server in development mode

          laravel-vue-spa-blog$ php artisan serve

* Start client in development mode. You should be able to go to `http://localhost:8000`

* To access to the administration panel, there is a link in the bottom of the page or go to `http://localhost:8000/login`

## Next step

* [ ] Create Laravel and React Single Page Application Forum

## Screens

#### Listing posts

<img alt="Listing posts" src="https://i.imgur.com/6pvqPKG.png" width="500">


#### Single Post page

<img alt="Post page" src="https://i.imgur.com/wvQLSYZ.png" width="500">

#### Creating comments

<img alt="Creating comments" src="https://i.imgur.com/KvK31Ny.png" width="500">


#### Login page

<img alt="Post page" src="https://i.imgur.com/eWHg0RG.png" width="500">


#### Create a post page (administration)

<img alt="Post page" src="https://i.imgur.com/8oiI6kd.png" width="500">

## License

MIT © 
