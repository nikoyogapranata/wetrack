<?php
include 'connection.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log incoming data
$logFile = "debug_log.txt";
file_put_contents($logFile, "POST Data: " . print_r($_POST, true) . "\n\n", FILE_APPEND);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $typePrisoner = $_POST['typePrisoner'];

    // Log the received values
    file_put_contents($logFile, "NIK: $nik\nNRT: $nrt\nType: $typePrisoner\n", FILE_APPEND);

    // Check if NIK and NRT exist
    $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
    if (!$stmt) {
        file_put_contents($logFile, "Prepare Error: " . $conn->error . "\n", FILE_APPEND);
        echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        file_put_contents($logFile, "No matching record found\n", FILE_APPEND);
        echo json_encode(["success" => false, "message" => "No matching record found"]);
        exit;
    }

    if ($typePrisoner == 'houseArrest') {
        $radiusFence = isset($_POST['radiusFence']) ? floatval($_POST['radiusFence']) : null;
        $centerLat = isset($_POST['centerLat']) ? floatval($_POST['centerLat']) : null;
        $centerLng = isset($_POST['centerLng']) ? floatval($_POST['centerLng']) : null;

        // Log house arrest values
        file_put_contents($logFile, "House Arrest - Radius: $radiusFence, Lat: $centerLat, Lng: $centerLng\n", FILE_APPEND);

        $query = "UPDATE mantan_narapidana SET 
                 prisoner_type = ?,
                 geofence_radius = ?,
                 geofence_lat = ?,
                 geofence_lng = ?,
                 city_district = NULL
                 WHERE nik = ? AND nrt = ?";
                 
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            file_put_contents($logFile, "Prepare Error: " . $conn->error . "\n", FILE_APPEND);
            echo json_encode(["success" => false, "message" => "Prepare error: " . $conn->error]);
            exit;
        }

        $stmt->bind_param("sdddss", $typePrisoner, $radiusFence, $centerLat, $centerLng, $nik, $nrt);
    } else if ($typePrisoner == 'cityPrisoner') {
        $kotaKab = $_POST['kotaKab'];
        
        // Log city prisoner values
        file_put_contents($logFile, "City Prisoner - City: $kotaKab\n", FILE_APPEND);

        $query = "UPDATE mantan_narapidana SET 
                 prisoner_type = ?,
                 city_district = ?,
                 geofence_radius = NULL,
                 geofence_lat = NULL,
                 geofence_lng = NULL
                 WHERE nik = ? AND nrt = ?";
                 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $typePrisoner, $kotaKab, $nik, $nrt);
    }

    if (!$stmt->execute()) {
        file_put_contents($logFile, "Execute Error: " . $stmt->error . "\n", FILE_APPEND);
        echo json_encode([
            "success" => false,
            "message" => "Execute error: " . $stmt->error,
            "debug" => $_POST
        ]);
        exit;
    }

    echo json_encode(["success" => true, "message" => "Data saved successfully"]);
    file_put_contents($logFile, "Data saved successfully\n", FILE_APPEND);

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>