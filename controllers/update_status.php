<?php
require_once '../config.php';
$mysqli = connect_to_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = $_POST['applicationId'];
    $newStatus = $_POST['status'];

    $updateQuery = "UPDATE applications SET status = '$newStatus' WHERE id = '$applicationId'";
    $updateResult = mysqli_query($mysqli, $updateQuery);

    if ($updateResult) {
        echo "Статус заявки успешно обновлен.";
    } else {
        echo "Ошибка при обновлении статуса заявки: " . mysqli_error($mysqli);
    }
}
