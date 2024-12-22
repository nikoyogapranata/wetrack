<?php
if (!defined('BASE_PATH')) {
    die('Direct access not permitted');
}

class AlertsHandler {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAlerts() {
        try {
            $sql = "SELECT 
                    dp.id,
                    dp.nama as name,
                    CONCAT(
                        'ID Napi: ', 
                        dp.id_napi,
                        ' - NIK: ',
                        dp.nik,
                        ' - Laporan: ',
                        COALESCE(dp.isi_laporan, 'No additional details')
                    ) as report,
                    DATE_FORMAT(dp.created_at, '%h:%i %p') as time,
                    dp.tanggal_laporan,
                    dp.unggah_foto
                    FROM data_polri dp 
                    ORDER BY dp.created_at DESC";
                    
            $result = mysqli_query($this->conn, $sql);
            
            if (!$result) {
                throw new Exception(mysqli_error($this->conn));
            }
            
            $alerts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Fix image path if needed
                if (!empty($row['unggah_foto']) && !str_starts_with($row['unggah_foto'], '/wetrack/')) {
                    $row['unggah_foto'] = '/wetrack/polri/' . $row['unggah_foto'];
                }
                $alerts[] = $row;
            }
            
            return ['status' => 'success', 'data' => $alerts];
            
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
    
    public function updateAlertStatus($id, $action) {
        try {
            mysqli_begin_transaction($this->conn);
            
            // Get alert details
            $stmt = mysqli_prepare($this->conn, "SELECT nama FROM data_polri WHERE id = ?");
            if (!$stmt) {
                throw new Exception(mysqli_error($this->conn));
            }
            
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception(mysqli_error($this->conn));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            $alert = mysqli_fetch_assoc($result);
            
            if (!$alert) {
                throw new Exception('Alert not found');
            }
            
            // Insert activity
            $description = $action === 'accept' ? 
                "Alert ID #{$id} for {$alert['nama']} was accepted" : 
                "Alert ID #{$id} for {$alert['nama']} was rejected";
            
            $action_type = $action === 'accept' ? 'alert_accepted' : 'alert_rejected';
            
            $stmt = mysqli_prepare($this->conn, 
                "INSERT INTO recent_activities (action_type, action_description) VALUES (?, ?)");
                
            if (!$stmt) {
                throw new Exception(mysqli_error($this->conn));
            }
            
            mysqli_stmt_bind_param($stmt, "ss", $action_type, $description);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception(mysqli_error($this->conn));
            }
            
            mysqli_commit($this->conn);
            
            return [
                'status' => 'success',
                'message' => 'Status updated successfully'
            ];
            
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
?>