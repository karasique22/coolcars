<?php
require_once '../config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$connection = connect_to_db();

$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['is_admin'] == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = 1;
        header("Location: ../pages/admin_cabinet.php");
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = 0;
        header("Location: ../pages/cabinet.php");
    }
} else {
    $message = "Неверные учетные данные. Пожалуйста, попробуйте еще раз.";
    header("Location: ../pages/auth.php?message=" . urlencode($message));
    exit();
}
