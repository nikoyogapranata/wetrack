<<<<<<< HEAD
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
        $sql = "SELECT 
                mn.id,
                mn.nama as name,
                CONCAT(
                    'Suspicious activity reported: ',
                    CASE 
                        WHEN mn.crime = 'TwA' THEN 'Terrorism with Arms'
                        WHEN mn.crime = 'Ot' THEN 'Other'
                        WHEN mn.crime = 'Fraud' THEN 'Fraud'
                        WHEN mn.crime = 'Assault' THEN 'Assault'
                        WHEN mn.crime = 'NO' THEN 'Narcotics Offense'
                        WHEN mn.crime = 'Embezzlement' THEN 'Embezzlement'
                        WHEN mn.crime = 'MvT' THEN 'Motor Vehicle Theft'
                        WHEN mn.crime = 'Robbery' THEN 'Robbery'
                        WHEN mn.crime = 'Brawling' THEN 'Brawling'
                        ELSE mn.crime
                    END,
                    ' - ',
                    COALESCE(report, 'No additional details')
                ) as report,
                DATE_FORMAT(created_at, '%h:%i %p') as time,
                action
                FROM mantan_narapidana mn 
                ORDER BY created_at DESC";
                
        $result = mysqli_query($this->conn, $sql);
        
        if (!$result) {
            return ['status' => 'error', 'message' => mysqli_error($this->conn)];
        }
        
        $alerts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $alerts[] = $row;
        }
        
        return ['status' => 'success', 'data' => $alerts];
    }
    
    public function updateAlertStatus($id, $action) {
        $id = (int)$id;
        $action_value = $action === 'accept' ? 1 : 0;
        
        // Menghapus updated_at dari query karena kolom tidak ada
        $sql = "UPDATE mantan_narapidana 
                SET action = ?
                WHERE id = ?";
                
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
            return [
                'status' => 'error',
                'message' => 'Failed to prepare statement: ' . mysqli_error($this->conn)
            ];
        }
        
        mysqli_stmt_bind_param($stmt, "ii", $action_value, $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if (!$success) {
            return [
                'status' => 'error',
                'message' => 'Failed to update status: ' . mysqli_error($this->conn)
            ];
        }
        
        return [
            'status' => 'success',
            'message' => 'Status updated successfully'
        ];
    }
=======
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
        $sql = "SELECT 
                mn.id,
                mn.nama as name,
                CONCAT(
                    'Suspicious activity reported: ',
                    CASE 
                        WHEN mn.crime = 'TwA' THEN 'Terrorism with Arms'
                        WHEN mn.crime = 'Ot' THEN 'Other'
                        WHEN mn.crime = 'Fraud' THEN 'Fraud'
                        WHEN mn.crime = 'Assault' THEN 'Assault'
                        WHEN mn.crime = 'NO' THEN 'Narcotics Offense'
                        WHEN mn.crime = 'Embezzlement' THEN 'Embezzlement'
                        WHEN mn.crime = 'MvT' THEN 'Motor Vehicle Theft'
                        WHEN mn.crime = 'Robbery' THEN 'Robbery'
                        WHEN mn.crime = 'Brawling' THEN 'Brawling'
                        ELSE mn.crime
                    END,
                    ' - ',
                    COALESCE(report, 'No additional details')
                ) as report,
                DATE_FORMAT(created_at, '%h:%i %p') as time,
                action
                FROM mantan_narapidana mn 
                ORDER BY created_at DESC";
                
        $result = mysqli_query($this->conn, $sql);
        
        if (!$result) {
            return ['status' => 'error', 'message' => mysqli_error($this->conn)];
        }
        
        $alerts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $alerts[] = $row;
        }
        
        return ['status' => 'success', 'data' => $alerts];
    }
    
    public function updateAlertStatus($id, $action) {
        $id = (int)$id;
        $action_value = $action === 'accept' ? 1 : 0;
        
        // Menghapus updated_at dari query karena kolom tidak ada
        $sql = "UPDATE mantan_narapidana 
                SET action = ?
                WHERE id = ?";
                
        $stmt = mysqli_prepare($this->conn, $sql);
        if (!$stmt) {
            return [
                'status' => 'error',
                'message' => 'Failed to prepare statement: ' . mysqli_error($this->conn)
            ];
        }
        
        mysqli_stmt_bind_param($stmt, "ii", $action_value, $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if (!$success) {
            return [
                'status' => 'error',
                'message' => 'Failed to update status: ' . mysqli_error($this->conn)
            ];
        }
        
        return [
            'status' => 'success',
            'message' => 'Status updated successfully'
        ];
    }
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
}