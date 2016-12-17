# ahichhatra-vivah
A wedding portal developed for the people of Ahichhatra community.

### Tech Used
* PHP 5.6
* Laravel 4.2
* MySQL 5.6 for database
* Blade HTML Templates
* Bootstrap for CSS
* Using MailGun as mail service

### Setup
* Clone the repo
* Install Docker
* Create a directory called `data` above the root directory. Create following additional directories in this created directory:
  * `db-data` - Mysql data
  * `profile_photos` - Profile photos
  * `config` - Laravel configuration
* Run `docker-compose up` in the root directory
* Open shell inside the app container using `docker-compose exec app sh` and do the following:
  * Download composer and run `composer.phar install`
  * Run `php artisan optimize`
  * Run `php artisan migrate`
* Fire up the browser on `http://localhost`
* Login using *admin@random.com* and *fakepassword* to get logged in as an admin
