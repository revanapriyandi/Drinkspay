<?php
$host = 'db';
$username = 'MYSQL_USER';
$password = 'MYSQL_PASSWORD';
$database = 'MYSQL_DATABASE';

$konek = new mysqli($host, $username, $password, $database);

if ($konek->connect_errno) {
    echo "Database Error: " . $konek->connect_error;
}
