<?php
define(HOST, 'localhost');
define(DATABASE, 'livebox');
define(USER, 'root');
define(PASSWORD, '');

$connectDB = new mysqli(HOST, USER, PASSWORD, DATABASE);

if($connectDB->connect_errno)
    echo "Error connect to DataBase. {$connectDB->connect_error}";
else
    echo "Connect success. Create a table...";