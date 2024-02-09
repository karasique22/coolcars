<?php
require_once '../config.php';

$mysqli = connect_to_db();

if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to connect to the database']);
    exit;
}

if (!isset($_GET['make']) || !isset($_GET['configuration'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing make or configuration']);
    exit;
}

$make = $_GET['make'];
$configurationId = $_GET['configuration'];

$query = "SELECT c.name AS color
          FROM cars AS ca
          JOIN colors AS c ON ca.color_id = c.id
          WHERE ca.make = ? AND ca.configuration_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('si', $make, $configurationId);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $colors = [];
    while ($row = $result->fetch_assoc()) {
        $colors[] = $row['color'];
    }

    echo json_encode(['colors' => $colors]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch colors']);
}

$stmt->close();
$mysqli->close();
?>
