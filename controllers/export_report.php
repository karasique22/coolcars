<?php
require_once '../config.php';
$mysqli = connect_to_db();

$query = "SELECT * FROM applications ORDER BY created_at DESC";
$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $applications = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = $_POST['applicationId'];
    $newStatus = $_POST['status'];

    $updateQuery = "UPDATE applications SET status = '$newStatus' WHERE id = '$applicationId'";
    $updateResult = mysqli_query($mysqli, $updateQuery);

    if ($updateResult) {
        $response = "Статус заявки успешно обновлен.";
        foreach ($applications as &$application) {
            if ($application['id'] === $applicationId) {
                $application['status'] = $newStatus;
                break;
            }
        }
    } else {
        $response = "Ошибка при обновлении статуса заявки: " . mysqli_error($mysqli);
    }

    echo json_encode($response);
    exit();
}

$html = '<table>';
$html .= '<tr><th>Фамилия</th><th>Имя</th><th>№</th><th>Телефон</th><th>Автомобиль</th><th>Услуга</th><th>Дата оформления</th><th>Статус заявки</th></tr>';

foreach ($applications as $application) {
    $html .= '<tr>';
    $html .= '<td>' . $application['last_name'] . '</td>';
    $html .= '<td>' . $application['first_name'] . '</td>';
    $html .= '<td>' . $application['id'] . '</td>';
    $html .= '<td>' . $application['phone'] . '</td>';
    $html .= '<td>' . $application['car_make'] . '</td>';
    $html .= '<td>' . $application['service'] . '</td>';
    $html .= '<td>' . $application['created_at'] . '</td>';
    $html .= '<td>' . $application['status'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=applications.xls");

echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
echo '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"></head>';
echo '<body>';
echo $html;
echo '</body></html>';

exit();
?>
