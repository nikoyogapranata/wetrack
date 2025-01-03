<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require __DIR__ . '/../../config/connection.php';

function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . "Delete Geofence Error: " . $message . "\n", 3, __DIR__ . '/delete_geofence_error.log');
}

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
        
        // Start transaction
        $conn->begin_transaction();

        try {
            // Delete from prisoner_geofence table
            $stmt = $conn->prepare("DELETE FROM prisoner_geofence WHERE nik IN (SELECT nik FROM mantan_narapidana WHERE id IN ($placeholders))");
            if (!$stmt) {
                throw new Exception("Error preparing statement for prisoner_geofence: " . $conn->error);
            }
            $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
            if (!$stmt->execute()) {
                throw new Exception("Error executing delete for prisoner_geofence: " . $stmt->error);
            }
            $geofenceAffected = $stmt->affected_rows;
            $stmt->close();

            // Delete from prisoner_location table
            $stmt = $conn->prepare("DELETE FROM prisoner_location WHERE prisoner_id IN ($placeholders)");
            if (!$stmt) {
                throw new Exception("Error preparing statement for prisoner_location: " . $conn->error);
            }
            $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
            if (!$stmt->execute()) {
                throw new Exception("Error executing delete for prisoner_location: " . $stmt->error);
            }
            $locationAffected = $stmt->affected_rows;
            $stmt->close();

            // Commit transaction
            $conn->commit();

            echo json_encode(['success' => true, 'geofenceDeleted' => $geofenceAffected, 'locationDeleted' => $locationAffected]);
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            logError($e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to delete records: ' . $e->getMessage()]);
        }
        
        if ($conn->error) {
            logError("MySQL error: " . $conn->error);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request: No IDs provided']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();

