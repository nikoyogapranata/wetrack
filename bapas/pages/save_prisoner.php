<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $prisonerType = $_POST['typePrisoner'];
    
    // Validate that the NIK and NRT exist in the mantan_narapidana table
    $checkQuery = "SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        die("Error: NIK and NRT combination not found in mantan_narapidana table.");
    }

    $geofence = '';

    if ($prisonerType == 'houseArrest') {
        $radius = $_POST['radiusFence'];
        $centerLat = $_POST['centerLat'];
        $centerLng = $_POST['centerLng'];
        $geofence = json_encode([
            'type' => 'circle',
            'center' => [$centerLat, $centerLng],
            'radius' => $radius
        ]);
    } elseif ($prisonerType == 'cityPrisoner') {
        $city = $_POST['kotaKab'];
        // Fetch GeoJSON data for the selected city
        $geojsonFile = "../geojson/{$city}.geojson";
        if (!file_exists($geojsonFile)) {
            die("Error: GeoJSON file not found for the selected city.");
        }
        $geofence = file_get_contents($geojsonFile);
    } else {
        die("Error: Invalid prisoner type.");
    }

    // Insert data into the geofencetbl table
    $query = "INSERT INTO geofencetbl (nik, nrt, prisoner_type, geofence, status) VALUES (?, ?, ?, ?, 'active')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nik, $nrt, $prisonerType, $geofence);

    if ($stmt->execute()) {
        echo "Geofence data saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Invalid request method.";
}
?>