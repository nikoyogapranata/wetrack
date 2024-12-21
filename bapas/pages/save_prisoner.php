<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $typePrisoner = $_POST['typePrisoner'];

    // Check if the NIK and NRT exist and belong to the same person
    $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "National ID Number or Prisoner Registration Number is not registered or does not belong to the same person."]);
        exit;
    }

    // If validation passes, proceed with saving the data
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
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Data saved successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving data: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}

