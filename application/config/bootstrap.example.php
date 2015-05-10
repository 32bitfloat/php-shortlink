<?php

/**
 * customize this
 */

define('SHORTENER_URL', 'http://yourdomain');
define('SHORTENER_BASE', '//yourdomain');

define('DESCRIPTION', 'this description appears as meta description and headline');
/*
 * DBMS to use with PDO
 * you need to ensure the appropriate PDO-package is installed
 * type is used inside the dns string, e. g. pgsql = Postgresql, mysql = MySQL
 */
define('DB_TYPE', 'pgsql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'databse');
define('DB_TABLE', 'table');
define('DB_USER', 'user');
define('DB_PASSWORD', 'password');


/**
 * end customization
 */

define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
define('APP_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', APP_PATH.'/core' );

spl_autoload_extensions(".php");
spl_autoload_register(function($classname){
    $path = CORE_PATH.'/'.$classname.'.php';
    if(is_file($path)){
        require($path);
    }
});
