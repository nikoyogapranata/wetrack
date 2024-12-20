<?php
require 'connection.php';

if(isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nrt = $_POST['nrt'];
    
    // File upload handling
    $target_dir = "uploads/";
    $file_extension = strtolower(pathinfo($_FILES["docInput"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid('doc_') . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;
    $uploadOk = 1;
    
    // Check if prisoner exists in mantan_narapidana
    $check_query = "SELECT nik FROM mantan_narapidana WHERE nik = ? AND nrt = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $nik, $nrt);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 0) {
        echo "<script>alert('Invalid NIK or NRT combination');</script>";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($_FILES["docInput"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($file_extension != "pdf" && $file_extension != "doc" && $file_extension != "docx") {
        echo "<script>alert('Sorry, only PDF, DOC & DOCX files are allowed.');</script>";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["docInput"]["tmp_name"], $target_file)) {
            // Prepare and execute the insert query
            $insert_query = "INSERT INTO final_reports (nik, nrt, docInput) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sss", $nik, $nrt, $target_file);
            
            if($stmt->execute()) {
                echo "<script>alert('Report uploaded successfully');</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}
?>