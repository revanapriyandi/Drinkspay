<?php
require '../connect.php';

$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


if (empty($email)) {
    $result = "Email tidak boleh kosong";
} elseif (empty($password)) {
    $result = "Password Tidak boleh kosong";
} elseif (empty($email) && empty($password)) {
    $ressult = "Emaik dan password tidak boleh kosong";
} else {
    $query = "SELECT * FROM users WHERE email='$email'";
    $execute = $konek->query($query);
    if ($execute->num_rows > 0) {
        $user = $execute->fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            if (isset($_POST['remember'])) {
                setcookie(
                    'rememberme',
                    $user['id'],
                    time() +  3600,
                    '/'
                );
            }
            echo '<script>window.location="../index.php"</script>';
        } else {
            echo '<script>alert("Email dan Password tidak cocok");history.go(-1)</script>';
        }
    } else {
        echo '<script>alert("Email tidak terdaftar");history.go(-1)</script>';
    }
}
