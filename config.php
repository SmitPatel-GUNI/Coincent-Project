<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'job_portal';

$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
    die("Connection Failed:" . mysqli_connect_error());
} else {
}
