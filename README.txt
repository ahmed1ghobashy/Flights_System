Please note that the project is running on Laravel 11 which requires php 8.2 or higher version>

To run the project:
1- Open Terminal in htdocs directory and run this: 
git clone https://github.com/ahmed1ghobashy/Flights_System.git

2- Open the terminal in the project directory and run the following command to create vendor directory:
composer install

3- Then run the following command to create the env file:
cp .env.example .env 

4- Then run this:
php artisan key:generate

5- Create database
 .Create a database called flight_system or you can choose the name you want but don't forget to change it from the .env file.
 .If you don't want to create it just simply open the terminal in te project directory and type php artisan migrate, you will be asked if you want the system to create the database, type yes

6- Run the migrations (If you haven't already run them)
 .Open the terminal in te project directory and run php artisan migrate, you will be asked if you want the system to create the database, type yes

7- Create seeders for the database
 .Open the terminal in te project directory and run php artisan db:seed

8- Finally you can use the system by running php artisan serve.