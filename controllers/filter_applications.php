<?php

require_once '../config.php';

$mysqli = connect_to_db();

$search = $_POST['search'];
$statusFilter = $_POST['statusFilter'];
$serviceFilter = $_POST['serviceFilter'];


$query = "SELECT * FROM applications WHERE 
    (last_name LIKE '%$search%' OR first_name LIKE '%$search%') AND
    (status = '$statusFilter' OR '$statusFilter' = '') AND
    (service = '$serviceFilter' OR '$serviceFilter' = '')
    ORDER BY created_at DESC";

$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($applications as $application) {
        echo '<tr>
            <td>' . $application['last_name'] . '</td>
            <td>' . $application['first_name'] . '</td>
            <td>' . $application['id'] . '</td>
            <td>' . $application['phone'] . '</td>
            <td>' . $application['car_make'] . '</td>
            <td>' . $application['service'] . '</td>
            <td>' . $application['created_at'] . '</td>
            <td>
                <form class="status-form form-group">
                    <input type="hidden" name="applicationId" value="' . $application['id'] . '">
                    <select name="status" class="form-select status-select">
                        <option value="На рассмотрении"' . ($application['status'] === 'На рассмотрении' ? ' selected' : '') . '>На рассмотрении</option>
                        <option value="На пути в автосалон"' . ($application['status'] === 'На пути в автосалон' ? ' selected' : '') . '>На пути в автосалон</option>
                        <option value="Готов"' . ($application['status'] === 'Готов' ? ' selected' : '') . '>Готов</option>
                    </select>
                </form>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="7">Нет данных</td></tr>';
}
