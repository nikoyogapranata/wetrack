<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    
    // First, get the file path
    $query = "SELECT docInput FROM final_report WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        $filePath = $row['docInput'];
        
        // Delete the record from the database
        $deleteQuery = "DELETE FROM final_report WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $id);
        
        if ($deleteStmt->execute()) {
            // If database deletion is successful, delete the file
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
        
        $deleteStmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Record not found']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>

