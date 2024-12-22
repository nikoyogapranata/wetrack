<?php
// Mendefinisikan path root dari project
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/wetrack/polri');
define('BASE_PATH', true);

// Menghapus semua output sebelumnya
ob_clean();

// Set headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

// Handle OPTIONS request untuk CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Menggunakan ROOT_PATH untuk include file
require $_SERVER['DOCUMENT_ROOT'] . '/wetrack/config/connection.php';
require_once(ROOT_PATH . '/includes/alerts_handler.php');

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $alertsHandler = new AlertsHandler($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $result = $alertsHandler->getAlerts();
        echo json_encode($result);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON input');
        }
        
        if (!isset($data['id']) || !isset($data['action'])) {
            throw new Exception('Missing required parameters');
        }
        
        if (!in_array($data['action'], ['accept', 'reject'])) {
            throw new Exception('Invalid action type');
        }
        
        $result = $alertsHandler->updateAlertStatus(
            $data['id'], 
            $data['action']
        );
        
        echo json_encode($result);
        exit;
    }

    throw new Exception('Invalid request method');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>