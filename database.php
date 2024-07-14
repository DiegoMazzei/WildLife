<?php


// Gets database info
$env = parse_ini_file('database.env');

// Checks if file exists
if ($env === false) {
    exit();
}


$host = $env['host'];
$username = $env['username'];
$password = $env['password'];
$database = $env['database'];

$connection = new mysqli($host, $username, $password, $database);

if ($connection -> connect_errno) {
    echo "There was an error when connecting to the DB";
    exit();
}
