<?php
if (!function_exists('logRecentActivity')) {
    function logRecentActivity($action_type, $description) {
        global $conn;
        
        if (!isset($conn)) {
            require_once __DIR__ . '/../connection.php';
        }
        
        $query = "INSERT INTO recent_activities (action_type, action_description) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $action_type, $description);
        
        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error logging activity: " . $e->getMessage());
            return false;
        } finally {
            $stmt->close();
        }
    }
}
?>