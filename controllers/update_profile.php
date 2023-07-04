<?php
require_once '../config.php';
$mysqli = connect_to_db();

$email = $_SESSION['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$birthdate = $_POST['birthdate'];

$query = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', patronymic = '$patronymic', phone = '$phone', birthdate = '$birthdate' WHERE email = '$email'";
$result = mysqli_query($mysqli, $query);

if ($result) {
    echo "success";
} else {
    echo "error";
}
?>
