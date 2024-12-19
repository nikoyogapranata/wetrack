<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Akhir</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .pdf-container {
            width: 100%;
            height: 600px;
            margin-bottom: 20px;
        }
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #06283D;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .download-btn:hover {
            background-color: #083d5f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <h1 class="profile-name">Laporan Akhir</h1>
            <div class="pdf-container">
                <iframe src="/frontend/pages/monitored-individuals/html/WETRACK - BYTE ME.pdf" width="100%" height="100%" style="border: none;"></iframe>
            </div>
            <a href="frontend/pages/monitored-individuals/html/final-report.html" download class="download-btn">Download PDF</a>
        </div>
    </div>
</body>
</html>