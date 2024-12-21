<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    $typePrisoner = $_POST['typePrisoner'];

    // Check if the NIK and NRT exist and belong to the same person
    $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        exit;
    }
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "National ID Number or Prisoner Registration Number is not registered or does not belong to the same person."]);
        exit;
    }

    // Update the mantan_narapidana table with geofence data
    if ($typePrisoner == 'houseArrest') {
        $radiusFence = $_POST['radiusFence'];
        $centerLat = $_POST['centerLat'];
        $centerLng = $_POST['centerLng'];

        $stmt = $conn->prepare("UPDATE mantan_narapidana SET prisoner_type = ?, geofence_radius = ?, geofence_lat = ?, geofence_lng = ?, city_district = NULL, updated_at = NOW() WHERE nik = ? AND nrt = ?");
        $stmt->bind_param("sdddss", $typePrisoner, $radiusFence, $centerLat, $centerLng, $nik, $nrt);
    } else if ($typePrisoner == 'cityPrisoner') {
        $kotaKab = $_POST['kotaKab'];

        $stmt = $conn->prepare("UPDATE mantan_narapidana SET prisoner_type = ?, city_district = ?, geofence_radius = NULL, geofence_lat = NULL, geofence_lng = NULL, updated_at = NOW() WHERE nik = ? AND nrt = ?");
        $stmt->bind_param("ssss", $typePrisoner, $kotaKab, $nik, $nrt);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid prisoner type."]);
        exit;
    }

    if ($stmt->execute()) {
        // If the update was successful, we'll fetch the updated data
        $stmt = $conn->prepare("SELECT * FROM mantan_narapidana WHERE nik = ? AND nrt = ?");
        $stmt->bind_param("ss", $nik, $nrt);
        $stmt->execute();
        $result = $stmt->get_result();
        $updatedData = $result->fetch_assoc();

        // Prepare the response data
        $responseData = [
            "success" => true,
            "message" => "Data saved successfully",
            "data" => [
                "nik" => $updatedData['nik'],
                "nrt" => $updatedData['nrt'],
                "name" => $updatedData['nama'],
                "prisoner_type" => $updatedData['prisoner_type'],
                "geofence_radius" => $updatedData['geofence_radius'],
                "geofence_lat" => $updatedData['geofence_lat'],
                "geofence_lng" => $updatedData['geofence_lng'],
                "city_district" => $updatedData['city_district']
            ]
        ];

        echo json_encode($responseData);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving data: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}