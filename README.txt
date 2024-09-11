Please note that the project is running on Laravel 11 which requires php 8.2 or higher version>

To run the project:
1- Create database
 .Create a database called flight_system or you can choose the name you want but don't forget to change it from the .env file.
 .If you don't want to create it just simply open the terminal in te project directory and type php artisan migrate, you will be asked if you want the system to create the database, type yes

2- Run the migrations (If you haven't already run them)
 .Open the terminal in te project directory and run php artisan migrate, you will be asked if you want the system to create the database, type yes

3- Create seeders for the database
 .Open the terminal in te project directory and run php artisan db:seed

4- Finally you can use the system by running php artisan serve.