# PHP Shortlink

## Description

Simple webapp to generate shorten urls.

## Requirements

* PHP >= 5.2
* PDO installed
* a PDO compatible database

## Installation

1. upload the code to your server
2. use `database.sql` to create the `redirect` table
3. use the `nginx.conf` example to set up your vhost
4. copy `application/config/bootstrap.example.php`  to `bootstrap.php` and change it to your needs

## Remarks

This app is developed and tested with nginx and postgresql.

It _should_ work with other DBMS thanks to PDO.

It _should_ work with other webservers if you point the host into the `public` directory and rewrite urls to `/index.php?shorty=$uri`.

## License

This script is available under the [WTFPL license](LICENSE.md).

