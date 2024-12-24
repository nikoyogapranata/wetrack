<?php
session_start();
require __DIR__ . '/../../../config/connection.php';

header('Content-Type: application/json');

try {
    // Get total tracked individuals
    $total_query = "SELECT COUNT(*) as total FROM mantan_narapidana";
    $total_result = mysqli_query($conn, $total_query);
    if (!$total_result) {
        throw new Exception(mysqli_error($conn));
    }
    $total_row = mysqli_fetch_assoc($total_result);
    $total_tracked = $total_row['total'];

    // Count alerts from recent_activities table instead
    $alerts_query = "SELECT 
        SUM(CASE WHEN action_type = 'alert_accepted' THEN 1 ELSE 0 END) as accepted,
        SUM(CASE WHEN action_type = 'alert_rejected' THEN 1 ELSE 0 END) as rejected
    FROM recent_activities 
    WHERE action_type IN ('alert_accepted', 'alert_rejected')";
    
    $alerts_result = mysqli_query($conn, $alerts_query);
    if (!$alerts_result) {
        throw new Exception(mysqli_error($conn));
    }
    $alerts_row = mysqli_fetch_assoc($alerts_result);

    // Get recent activities
    $recent_query = "SELECT 
        action_type,
        action_description,
        created_at 
    FROM recent_activities 
    ORDER BY created_at DESC 
    LIMIT 5";
    
    $recent_result = mysqli_query($conn, $recent_query);
    if (!$recent_result) {
        throw new Exception(mysqli_error($conn));
    }
    
    $recent_activities = [];
    while($row = mysqli_fetch_assoc($recent_result)) {
        $recent_activities[] = [
            'type' => $row['action_type'],
            'description' => $row['action_description'],
            'timestamp' => $row['created_at']
        ];
    }

    // Get monthly data for chart
    $monthly_query = "SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as month,
        COUNT(*) as count
    FROM mantan_narapidana
    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
    ORDER BY month DESC
    LIMIT 6";
    
    $monthly_result = mysqli_query($conn, $monthly_query);
    if (!$monthly_result) {
        throw new Exception(mysqli_error($conn));
    }
    
    $monthly_data = [];
    while($row = mysqli_fetch_assoc($monthly_result)) {
        $monthly_data[] = $row;
    }

    $response = [
        'status' => 'success',
        'total_tracked' => intval($total_tracked),
        'alerts_accepted' => intval($alerts_row['accepted'] ?? 0),
        'alerts_rejected' => intval($alerts_row['rejected'] ?? 0),
        'recent_activities' => $recent_activities,
        'monthly_data' => array_reverse($monthly_data) // Reverse to show chronological order
    ];

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>