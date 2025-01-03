<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../config/connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $typePrisoner = $_POST['typePrisoner'];

    // Check if the prisoner already exists
    $check_query = "SELECT id FROM mantan_narapidana WHERE nik = ? AND nrt = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $nik, $nrt);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Prisoner exists, update the record
        $prisoner_id = $check_result->fetch_assoc()['id'];
        if ($typePrisoner === 'houseArrest') {
            $update_query = "UPDATE mantan_narapidana SET geofence_type = ?, geofence_radius = ?, geofence_lat = ?, geofence_lng = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sdddi", $typePrisoner, $_POST['radiusFence'], $_POST['centerLat'], $_POST['centerLng'], $prisoner_id);
        } else {
            $update_query = "UPDATE mantan_narapidana SET geofence_type = ?, geofence_city_district = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ssi", $typePrisoner, $_POST['kotaKab'], $prisoner_id);
        }
        $success = $update_stmt->execute();
    } else {
        // New prisoner, insert a new record
        if ($typePrisoner === 'houseArrest') {
            $insert_query = "INSERT INTO mantan_narapidana (nik, nrt, geofence_type, geofence_radius, geofence_lat, geofence_lng) VALUES (?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("sssddd", $nik, $nrt, $typePrisoner, $_POST['radiusFence'], $_POST['centerLat'], $_POST['centerLng']);
        } else {
            $insert_query = "INSERT INTO mantan_narapidana (nik, nrt, geofence_type, geofence_city_district) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("ssss", $nik, $nrt, $typePrisoner, $_POST['kotaKab']);
        }
        $success = $insert_stmt->execute();
    }

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error saving data: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}