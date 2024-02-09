<?php
include '../config.php';
$mysqli = connect_to_db();

$car_make = $_POST['car_make'];
$car_configuration = $_POST['car_configuration'];
$car_color = $_POST['car_color'];
$service = $_POST['service'];
$status = 'На рассмотрении';
$created_at = date('Y-m-d H:i:s');
$source = $_POST['source'];

if ($car_make == 'RollsRoyce') {
    $car_make = 'Rolls-Royce';
}

if ($car_configuration == 1) {
    $car_configuration = 'Стандартная';
} elseif ($car_configuration == 2) {
    $car_configuration = 'Полная';
} else {
    $car_configuration = 'Неизвестная';
}

if ($source == "form") {
    $first_name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $last_name = '';

    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($mysqli, $checkQuery);
    $count = mysqli_fetch_row($checkResult)[0];

    if ($count > 0) {
        echo '<script>alert("Ошибка регистрации. Пользователь с таким email уже существует.");</script>';
        header("Location: ../index.php?message=" . urlencode("registered"));
        exit();
    } else {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }

        include 'register_process.php';
        // господи помилуй
        goto afterForm;
    }
} else {
    $email = $_SESSION['email'];

    $query = "SELECT first_name, last_name, phone FROM users WHERE email = '$email'";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
    } else {
        echo '<script>alert("Ошибка получения данных пользователя.");</script>';
        header("Location: ../index.php?message=" . urlencode("error"));
        exit();
    }
}

afterForm:

$sql = "INSERT INTO applications (first_name, last_name, phone, email, car_make, car_configuration, car_color, service, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    echo "Ошибка при подготовке SQL-запроса: " . $mysqli->error;
    exit;
}

$stmt->bind_param("ssssssssss", $first_name, $last_name, $phone, $email, $car_make, $car_configuration, $car_color, $service, $status, $created_at);

if ($stmt->execute()) {
    header("Location: ../index.php?message=" . urlencode("success"));
    $stmt->close();
    $mysqli->close();
    exit();
} else {
    header("Location: ../index.php?message=" . urlencode("fault"));
    $stmt->close();
    $mysqli->close();
    exit();
}
