<?php
include 'connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to log errors
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, 'error.log');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nik = $_POST['nik'];
        $nrt = $_POST['nrt'];
        $typePrisoner = $_POST['typePrisoner'];

        // Check if the NIK and NRT exist and belong to the same person
        $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
        $stmt->bind_param("ss", $nik, $nrt);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            throw new Exception("National ID Number or Prisoner Registration Number is not registered or does not belong to the same person.");
        }

        // If validation passes, proceed with saving the data
        // Debug: Log the values being inserted
        error_log("Inserting: NIK=$nik, NRT=$nrt, Type=$typePrisoner");
        if ($typePrisoner == 'houseArrest') {
            $radiusFence = $_POST['radiusFence'];
            $centerLat = $_POST['centerLat'];
            $centerLng = $_POST['centerLng'];
            
            // Save house arrest data
            $stmt = $conn->prepare("INSERT INTO prisoner_locations (nik, nrt, type, radius, center_lat, center_lng) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssddd", $nik, $nrt, $typePrisoner, $radiusFence, $centerLat, $centerLng);
        } else if ($typePrisoner == 'cityPrisoner') {
            $kotaKab = $_POST['kotaKab'];
            
            // Save city prisoner data
            $stmt = $conn->prepare("INSERT INTO prisoner_locations (nik, nrt, type, city_district) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nik, $nrt, $typePrisoner, $kotaKab);
        } else {
            throw new Exception("Invalid prisoner type.");
        }

        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        echo json_encode(["success" => true, "message" => "Data saved successfully"]);
    } catch (Exception $e) {
        logError('Error in save_prisoner.php: ' . $e->getMessage());
        echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}