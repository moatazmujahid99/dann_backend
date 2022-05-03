# important Notes

## How to get project and test it

### step 1:
clone project to your computer using

- `git clone https://github.com/moatazmujahid99/api.dann.git`

### step 2:
get into project using  `cd api.dann` command.


### step 3:
do the following commands <br>
- `composer install` <br>
- create a database called **dann** in mysql <br>
- `cp .env.example .env` <br>
- go to .env file and make *DB_DATABASE=dann* <br>
- `php artisan key:generate` <br>
- `php artisan migrate` *( dont forget to start apache and MySQL form XAMPP )* <br>
- `php artisan passport:install` <br>
- `php artisan serve` <br>
