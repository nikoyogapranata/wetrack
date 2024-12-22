<?php
require __DIR__ . '/../../config/connection.php';

$alterTableQuery = "ALTER TABLE mantan_narapidana 
    ADD COLUMN IF NOT EXISTS prisoner_type ENUM('houseArrest', 'cityPrisoner') DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS radiusFence FLOAT DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS centerLat FLOAT DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS centerLng FLOAT DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS city_district VARCHAR(100) DEFAULT NULL";

if ($conn->query($alterTableQuery) === TRUE) {
    echo "Table 'mantan_narapidana' updated successfully";
} else {
    echo "Error updating table: " . $conn->error;
}

$conn->close();
?>

