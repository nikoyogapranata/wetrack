<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/../../config/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['ids']) && is_array($data['ids'])) {
        $ids = array_map('intval', $data['ids']);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        // Prepare the DELETE statement
        $stmt = $conn->prepare("DELETE FROM mantan_narapidana WHERE id IN ($placeholders)");
        $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete records']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request: No IDs provided']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();