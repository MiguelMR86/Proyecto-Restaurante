# Restaurant-Project
In this project we will deploy a CRUD project about a restaurant.

## Overview
This project is a website for a restaurant that allows users to view the menu and make reservations.
The website is built using PHP and MySQL database to store information about clients and reservations.

![](https://i.imgur.com/xVzPfnO.jpg)

## Instalation
1. Clone the repository to your local machine
```shell=
$'git clone https://github.com/MiguelMR86/Proyecto-Restaurante.git'
```

2. Once you clone the repository you will need to install the composer dependencies, you can do it by typing
```shell=
$'composer install'
```

3. Then you will need to install the database in xampp, just run MySQL service log in shell with
```shell=
$'mysql -u root'
```

4. Copy the SQL file content and paste it into the xampp shell 

5. Finnaly you will need to create a file named '.env', here you will save the environment variables I will put you an example.
```env=
DB_HOST ='localhost'
DB_USER = 'root'
DB_PASS = ''
DB_NAME = 'restaurant'
```

## Run
You can run it just typing
```shell=
$'php -S localhost:8000'
```


## Usage (not logged)
1. View the menu, you will see two buttons called "sign in" and "sign up", you will only have acces to the index page, by registering and logging on the page you will have access to the whole page content.

## Usage (client and admin) 
1. View the menu, you will see a buttons called "Let's start" by clicking it you will go to 
   the users page.

2. As a client, you will have access to all the information of your reservations and 
   also you can make and update them.

3. As an admin, you will have access to all the information of all users, and also you 
   can update them and remove them from the database.

## Author
- Miguel Ángel Medina Ramírez

## Deploy Link
- https://restaurant-project.herokuapp.com/index.php

## Documentation
- https://restaurant-project.herokuapp.com/docs/html/index.html