<?php
// Mendefinisikan path root dari project
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/wetrack/polri');
define('BASE_PATH', true);

// Menggunakan ROOT_PATH untuk include file
require_once(ROOT_PATH . '/config/database.php');
require_once(ROOT_PATH . '/includes/alerts_handler.php');

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0); // Matikan PHP error output

try {
    $alertsHandler = new AlertsHandler($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo json_encode($alertsHandler->getAlerts());
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
        
        $result = $alertsHandler->updateAlertStatus(
            $data['id'], 
            $data['action']
        );
        
        echo json_encode($result);
        exit;
    }

    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}