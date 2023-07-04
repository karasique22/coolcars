<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


require_once '../config.php';

$connection = connect_to_db();

$email = $_POST['email'];
$firstName = $_POST['name'];
$lastName = $_POST['last_name'];
$phone = $_POST['phone'];

$checkQuery = "SELECT COUNT(*) FROM users WHERE email = '$email'";
$checkResult = mysqli_query($connection, $checkQuery);
$count = mysqli_fetch_row($checkResult)[0];

if ($count > 0) {
    $message = "Ошибка регистрации. Пользователь с таким email уже существует.";
    header("Location: ../pages/register.php?message=" . urlencode($message));
} else {
    $password = generatePassword();

    $query = "INSERT INTO users (email, password, first_name, last_name, phone)
              VALUES ('$email', '$password', '$firstName', '$lastName', '$phone')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $message = "Регистрация прошла успешно. Пароль отправлен на вашу почту.";
        sendPasswordEmail($email, $password);
        header("Location: ../pages/auth.php?message=" . urlencode($message));
    } else {
        $message = "Ошибка регистрации. Пожалуйста, попробуйте еще раз.";
        header("Location: ../pages/register.php?message=" . urlencode($message));
    }
}

function generatePassword()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}

function sendPasswordEmail($email, $password)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 1025;

        $mail->setFrom('coolcars@gmail.com', 'Coolcars');
        $mail->addAddress($email);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Пароль для вашего личного кабинета';
        $mail->Body = 'Ваш пароль: ' . $password;

        $mail->send();
        error_log('Письмо успешно отправлено');
    } catch (Exception $e) {
        error_log('Ошибка при отправке письма: ' . $mail->ErrorInfo);
    }
}
