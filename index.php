<?php
session_start();
if (empty($_SESSION['user']) and empty($_SESSION['pass'])) {
    include 'login.php';
} else {
    include 'dashboard.php';
}
