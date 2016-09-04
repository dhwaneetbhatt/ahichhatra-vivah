# ahichhatra-vivah
A wedding portal developed for the people of Ahichhatra community.

### Tech Used
* PHP 5.5
* Laravel 4.2
* MySQL 5.5 for database
* Blade HTML Templates
* Bootstrap for CSS
* Deployed on openshift
* Using MailGun as mail service

### Setup
* Install PHP 5.5, MySQL 5.5 and Apache
* Make the root repo dir as the document root in apache
* Create database 'achichhatra' in MySQL
* Update your hostname in bootstrap/start.php against 'dev' (replace 'sunshine', do not commit this file)
* Update MySQL user and password in app/config/dev/database.php
* Run `./composer.phar install` (download composer if using Windows/MacOS)
* Run `php aritsan migrate`
* Fire up the browser on `http://localhost` (add port as per your Apache's configuration)
* Login using *admin@random.com* and *fakepassword* to get logged in as an admin
