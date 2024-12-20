<<<<<<< HEAD
<?php
require_once 'database.php';

// SQL untuk membuat tabel mantan_narapidana
$sql = "CREATE TABLE IF NOT EXISTS `mantan_narapidana` (
    `id` int NOT NULL AUTO_INCREMENT,
    `fileInput` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nik` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nrt` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `dateBirth` date DEFAULT NULL,
    `address` text COLLATE utf8mb4_general_ci,
    `gender` enum('male','female') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nationality` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `crime` enum('TwA','Ot','Fraud','Assault','NO','Embezzlement','MvT','Robbery','Brawling') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `case` text COLLATE utf8mb4_general_ci,
    `punishment` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `releaseDate` date DEFAULT NULL,
    `report` text COLLATE utf8mb4_general_ci DEFAULT NULL,
    `action` boolean DEFAULT NULL COMMENT '1 for accept, 0 for reject',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    echo "Tabel mantan_narapidana berhasil dibuat atau sudah ada<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Cek apakah kolom report dan action sudah ada
$result = mysqli_query($conn, "SHOW COLUMNS FROM `mantan_narapidana` LIKE 'report'");
if (mysqli_num_rows($result) == 0) {
    $alterTable = "ALTER TABLE `mantan_narapidana` 
                   ADD COLUMN `report` text COLLATE utf8mb4_general_ci DEFAULT NULL AFTER `releaseDate`";
    
    if (mysqli_query($conn, $alterTable)) {
        echo "Kolom report berhasil ditambahkan<br>";
    } else {
        echo "Error menambahkan kolom report: " . mysqli_error($conn) . "<br>";
    }
}

$result = mysqli_query($conn, "SHOW COLUMNS FROM `mantan_narapidana` LIKE 'action'");
if (mysqli_num_rows($result) == 0) {
    $alterTable = "ALTER TABLE `mantan_narapidana` 
                   ADD COLUMN `action` boolean DEFAULT NULL 
                   COMMENT '1 for accept, 0 for reject' AFTER `report`";
    
    if (mysqli_query($conn, $alterTable)) {
        echo "Kolom action berhasil ditambahkan<br>";
    } else {
        echo "Error menambahkan kolom action: " . mysqli_error($conn) . "<br>";
    }
}

// Tutup koneksi
mysqli_close($conn);
=======
<?php
require_once 'database.php';

// SQL untuk membuat tabel mantan_narapidana
$sql = "CREATE TABLE IF NOT EXISTS `mantan_narapidana` (
    `id` int NOT NULL AUTO_INCREMENT,
    `fileInput` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nik` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nrt` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `dateBirth` date DEFAULT NULL,
    `address` text COLLATE utf8mb4_general_ci,
    `gender` enum('male','female') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `nationality` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `crime` enum('TwA','Ot','Fraud','Assault','NO','Embezzlement','MvT','Robbery','Brawling') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `case` text COLLATE utf8mb4_general_ci,
    `punishment` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `releaseDate` date DEFAULT NULL,
    `report` text COLLATE utf8mb4_general_ci DEFAULT NULL,
    `action` boolean DEFAULT NULL COMMENT '1 for accept, 0 for reject',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    echo "Tabel mantan_narapidana berhasil dibuat atau sudah ada<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Cek apakah kolom report dan action sudah ada
$result = mysqli_query($conn, "SHOW COLUMNS FROM `mantan_narapidana` LIKE 'report'");
if (mysqli_num_rows($result) == 0) {
    $alterTable = "ALTER TABLE `mantan_narapidana` 
                   ADD COLUMN `report` text COLLATE utf8mb4_general_ci DEFAULT NULL AFTER `releaseDate`";
    
    if (mysqli_query($conn, $alterTable)) {
        echo "Kolom report berhasil ditambahkan<br>";
    } else {
        echo "Error menambahkan kolom report: " . mysqli_error($conn) . "<br>";
    }
}

$result = mysqli_query($conn, "SHOW COLUMNS FROM `mantan_narapidana` LIKE 'action'");
if (mysqli_num_rows($result) == 0) {
    $alterTable = "ALTER TABLE `mantan_narapidana` 
                   ADD COLUMN `action` boolean DEFAULT NULL 
                   COMMENT '1 for accept, 0 for reject' AFTER `report`";
    
    if (mysqli_query($conn, $alterTable)) {
        echo "Kolom action berhasil ditambahkan<br>";
    } else {
        echo "Error menambahkan kolom action: " . mysqli_error($conn) . "<br>";
    }
}

// Tutup koneksi
mysqli_close($conn);
>>>>>>> abf4a73c3f951eb0aff569238a7d2f07274f5459
?>