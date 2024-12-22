<?php
require __DIR__ . '/../../config/connection.php';  // Corrected path


// Set header as JSON
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);


    
    $query = "SELECT * FROM data_polri WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
} else {
    echo json_encode(['error' => 'ID tidak diberikan']);
}
?>