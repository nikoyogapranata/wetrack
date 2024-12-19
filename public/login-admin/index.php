<?php
session_start(); // Start the session
require_once 'config.php'; // Include your database configuration

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize the form inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($id && $password) {
        try {
            // Prepare SQL statement to find the user by ID
            $stmt = $pdo->prepare("SELECT * FROM kemenkumham_users WHERE id = ?");
            $stmt->execute([$id]); // Execute the query with the provided ID
            $user = $stmt->fetch(); // Fetch the user data

            // Check if the user exists and if the password is correct
            if ($user && password_verify($password, $user['password'])) {
                // Store user ID in session if login is successful
                $_SESSION['user_id'] = $user['id'];
                // Redirect to the home page after successful login
                header('Location: /wetrack/kemenkumham/pages/home.php');
                exit();
            }

            // If credentials are incorrect
            $error = 'Invalid credentials';
        } catch (PDOException $e) {
            // Catch database connection errors
            $error = 'Database error: ' . $e->getMessage();
        }
    } else {
        // If either ID or password is missing
        $error = 'Please provide both ID and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Interface</title>
    <meta content="Login interface design." name="description" />
    <meta property="og:title" content="Login Interface" />
    <meta property="twitter:title" content="Login Interface" />
    <meta property="og:type" content="website" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="css/webflow-style.css" rel="stylesheet" type="text/css" />
    <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="images/app-icon.png" rel="apple-touch-icon" />
</head>

<body>
    <div class="page-wrapper">
        <div class="page-container">
            <div class="block-1">
                <div class="content-wrapper">
                    <a href="/frontend/pages/public/landing-page/index.html" class="nav-footer-logo w-nav-brand">
                        <img width="40" sizes="40px" alt="" src="images/logo-white.png" loading="lazy" />
                        <div class="logo-text logo-text-footer">WETRACK</div>
                    </a>
                    <div class="content-box">
                        <h1 class="heading-1">Welcome back, Kemenkumham Admin! Please log in to manage accounts, monitor activities, and oversee reports.</h1>
                    </div>
                    <div class="legal-box _2">
                        <div class="legal-text">© 2024 WETRACK. All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-container _2">
            <div class="block-2">
                <div class="form-wrapper">
                    <h2 class="heading-2">Login to WETRACK</h2>
                    <div class="form-box">
                        <h3 class="heading-4">Please log in with your credentials to access the system. Unauthorized use is strictly prohibited and monitored.</h3>
                        <div class="div-block-6-copy"></div>
                        <div class="w-form">
                            <?php if (isset($error)): ?>
                                <div style="color: red; margin-bottom: 15px;"><?php echo htmlspecialchars($error); ?></div>
                            <?php endif; ?>
                            <form id="email-form" name="email-form" method="post" action="index.php">
                                <div class="form-field-wrapper">
                                    <div class="text-field-box _2">
                                        <label for="id" class="field-label-2">ID</label>
                                        <input class="text-field-2 w-input" maxlength="256" name="id" placeholder="ID" type="text" id="id" required />
                                    </div>
                                    <div class="text-field-box _2">
                                        <label for="password-2" class="field-label-2">Password</label>
                                        <input class="text-field-2 w-input" maxlength="256" name="password" placeholder="Password" type="password" id="password-2" required />
                                    </div>
                                </div>
                                <input type="submit" class="button registration w-button" value="Login" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="legal-box _2-copy">
                    <div class="legal-text _3">© 2024 WETRACK. All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/webflow-script.js" type="text/javascript"></script>
</body>

</html>
