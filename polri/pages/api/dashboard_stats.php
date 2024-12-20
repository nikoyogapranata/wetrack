<?php
session_start();
require_once "../../config/database.php";

header('Content-Type: application/json');

// Get total tracked individuals (total napi)
$total_query = "SELECT COUNT(*) as total FROM mantan_narapidana";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_tracked = $total_row['total'];

// Get accepted alerts count
$accepted_query = "SELECT COUNT(*) as accepted FROM mantan_narapidana WHERE action = 1";
$accepted_result = mysqli_query($conn, $accepted_query);
$accepted_row = mysqli_fetch_assoc($accepted_result);
$alerts_accepted = $accepted_row['accepted'];

// Get rejected alerts count
$rejected_query = "SELECT COUNT(*) as rejected FROM mantan_narapidana WHERE action = 0";
$rejected_result = mysqli_query($conn, $rejected_query);
$rejected_row = mysqli_fetch_assoc($rejected_result);
$alerts_rejected = $rejected_row['rejected'];

// Get recent activities
$recent_query = "SELECT nama, action, created_at FROM mantan_narapidana ORDER BY created_at DESC LIMIT 5";
$recent_result = mysqli_query($conn, $recent_query);
$recent_activities = [];
while($row = mysqli_fetch_assoc($recent_result)) {
    $recent_activities[] = $row;
}

$response = [
    'total_tracked' => $total_tracked,
    'alerts_accepted' => $alerts_accepted,
    'alerts_rejected' => $alerts_rejected,
    'recent_activities' => $recent_activities
];

echo json_encode($response);
?>