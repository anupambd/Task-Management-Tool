This is the simple Task tool management

Technologies:

	Language: Php above 7.3
	Database: Mysql 
	Framework: laravel 8

Project Run Procedure:

	Rename file .example.env to .env 
Set database setting in .env file
Just update this portion : 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=management
DB_USERNAME=root
DB_PASSWORD=

	Open command prompt in Task-Management-Tool folder
	Run Composer update Command
Command: composer update
	Run migration and seed command
Command: php artisan migrate and then  php artisan db:seed
	At last Run the project
Command : php artisan serve

