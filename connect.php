<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'toko_minuman';

$konek = new mysqli($host, $username, $password, $database);

if ($konek->connect_errno) {
    echo "Database Error: " . $konek->connect_error;
}
