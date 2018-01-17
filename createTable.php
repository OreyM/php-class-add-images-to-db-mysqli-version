<?php

define('HOST', 'localhost');
define('DATABASE', 'livebox');
define('USER', 'root');
define('PASSWORD', '');

$connectDB = new mysqli(HOST, USER, PASSWORD, DATABASE);

if($connectDB->connect_errno) {

    echo "\n\033[" . implode(';', array(46, 41)) . 'm' . 'Error connect to DataBase' . "\033[0m\n\n";
    echo "\n\033[" . implode(';', array(46, 41)) . 'm' . $connectDB->connect_error . "\033[0m\n\n";

    exit();

}else {

    echo "\n\033[" . implode(';', array(46, 42)) . 'm' . 'Connect success. Creating a table...' . "\033[0m\n\n";

    sleep(1);

    $query = "CREATE TABLE images_db (
            id          INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
            image_name  VARCHAR(100)  NOT NULL,
            mime_type   VARCHAR(100)  NOT NULL,
            image_size  INT           NOT NULL,
            image_data  MEDIUMBLOB    NOT NULL
          );";

    if($connectDB->query($query))

        echo "\n\033[" . implode(';', array(46, 42)) . 'm' . 'Table created' . "\033[0m\n";

    else{

        echo "\n\033[" . implode(';', array(46, 41)) . 'm' . 'Error creating table' . "\033[0m";
        echo "\n\033[" . implode(';', array(46, 41)) . 'm' . $connectDB->error . "\033[0m\n";

    }
}