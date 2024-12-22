<?php
require __DIR__ . '/../../config/connection.php';

$id = $_GET['id'];

$query = "SELECT centerLat, centerLng, radiusFence FROM mantan_narapidana WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $response = [
        'center' => [
            'lat' => floatval($row['centerLat']),
            'lng' => floatval($row['centerLng'])
        ],
        'radius' => floatval($row['radiusFence']) * 1000 // Convert km to meters
    ];
} else {
    $response = ['error' => 'No geofence data found'];
}

header('Content-Type: application/json');
echo json_encode($response);

