# Tinta Schedule #

## Description ##
Web Application for Ink and Thunder Tatoo.

## Requirements ##
* [PHP 5.4.1 or higher](http://www.php.net/)
* [Bootstrap](http://getbootstrap.com/)
* [Slim Framework](http://www.slimframework.com/)
* [JQuery](https://jquery.com/)
* [Google Calendar](https://developers.google.com/google-apps/calendar/)

## Developer Documentation ##
Execute phpdoc -d classes/

## Installation ##
Clone Repository.
Execute composer.phar install.

## Configuration File ##
~~~
<?php
define("APP_URL", "http://localhost/tintasc/");

//Facebook
define("APP_KEY", "");
define("APP_SECRET", "");
define("CALLBACK", "");

// MySQL
define("DB_HOST", "localhost");
define("DB_NAME", "");
define("DB_USER", "");
define("DB_PASSWORD", "");
define("DB_PORT", 3306);

// Google
define("PROJECT_ID", "");
define("P12_FILE", "/path/to/credentials/file.p12");
define("DEVELOPER_EMAIL", "configurated_email@developer.gserviceaccount.com");
define("CALENDAR_ID", "calendar_id@group.calendar.google.com");
?>
~~~

## Notes ##
This application needs a gmail account and a google calendar shared.

P.D. Let's go play !!!




