# important Notes

## How to get project and test it

<br> 

### step 1:
clone project to your computer using

- `git clone https://github.com/moatazmujahid99/dann_backend.git`

<br>

### step 2:
get into project using  `cd dann_backend` command.

<br>

### step 3:
do the following commands <br>
- `composer install`<br>
- `npm install``<br>
- `cp .env.example .env` <br>
- go to .env file and make *DB_DATABASE=dann* <br>
- - create a database called **dann** in mysql
- `php artisan key:generate` <br>
- `php artisan migrate` *( dont forget to start apache and MySQL form XAMPP )* <br>
- `php artisan serve` <br>

after that go to link localhost:8000 and make sure every thing work correctly

<br>

### step 4:
use "api_development" branch
- `git checkout api_development`


