# Restaurant-Project
In this project we will deploy a CRUD with HTML, Javascript, PHP and MySQL

## Instalation
To clone the repository you will need to type
$'git clone https://github.com/MiguelMR86/Proyecto-Restaurante.git'

Once you clone the repository you WIIL need to install the composer dependencies, you can do it by typing
$'composer install'

Then you will need to install the database in xampp, just run MySQL service
log in shell with
$'mysql -u root'

Copy the file content and paste it into the xampp shell
$'mysql -u root'

Finnaly you will need to create a file named '.env', here you will save the environment variables I will put you an example.
'
DB_HOST = 'localhost'
DB_USER = 'root'
DB_PASS = ''
DB_NAME = 'restaurant'
'

## Run
You can run it just typing
$'php -S localhost:8000'