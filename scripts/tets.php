<?php
require_once '../config/config.php';
require_once '../class/ImagesDB.php';

$connectDB = new mysqli(HOST, USER, PASSWORD, DATABASE);

$addImage = new ImagesDB($connectDB);

$addImage->addImageToDB();

$connectDB->close();