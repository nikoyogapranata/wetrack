<?php
require __DIR__ . '/../../config/connection.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $typePrisoner = $_POST['typePrisoner'];

    // Check if NIK and NRT exist in mantan_narapidana table
    $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "No matching record found in mantan_narapidana"]);
        exit;
    }

    // Check if a record already exists in prisoner_geofence
    $stmt = $conn->prepare("SELECT * FROM prisoner_geofence WHERE nik = ? AND nrt = ?");
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Geofence data already exists for this prisoner"]);
        exit;
    }

    // Prepare data for insertion
    $radiusFence = ($typePrisoner == 'houseArrest') ? floatval($_POST['radiusFence']) : null;
    $centerLat = ($typePrisoner == 'houseArrest') ? floatval($_POST['centerLat']) : null;
    $centerLng = ($typePrisoner == 'houseArrest') ? floatval($_POST['centerLng']) : null;
    $city_district = ($typePrisoner == 'cityPrisoner') ? $_POST['kotaKab'] : null;

    // Insert new record
    $query = "INSERT INTO prisoner_geofence (nik, nrt, prisoner_type, radiusFence, centerLat, centerLng, city_district) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssddds", $nik, $nrt, $typePrisoner, $radiusFence, $centerLat, $centerLng, $city_district);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Data saved successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving data: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
