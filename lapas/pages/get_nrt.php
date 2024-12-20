<?php
require 'connection.php';

if(isset($_POST['nik'])) {
    $nik = $_POST['nik'];
    $query = "SELECT nrt FROM mantan_narapidana WHERE nik = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()) {
        echo json_encode(['nrt' => $row['nrt']]);
    } else {
        echo json_encode(['nrt' => '']);
    }
}
?>