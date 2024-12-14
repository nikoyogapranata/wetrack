<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wetrack-expo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nik = $_POST['nik'];
$name = $_POST['nama'];
$dateBirth = $_POST['dateBirth'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$crime = $_POST['crime'];
$case = $_POST['case'];
$punishment = $_POST['punishment'];
$releaseDate = $_POST['releaseDate'];

if (!empty($_FILES['photo']['name'])) {
    $photo = $_FILES['photo']['name'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        echo "Photo uploaded successfully.";
    } else {
        echo "Failed to upload photo.";
        $photo = null;
    }
} else {
    $photo = null;
}

$sql = "INSERT INTO inmates (nik, name, date_birth, address, gender, nationality, crime, case_report, punishment, release_date, photo)
        VALUES ('$nik', '$name', '$dateBirth', '$address', '$gender', '$nationality', '$crime', '$case', '$punishment', '$releaseDate', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
