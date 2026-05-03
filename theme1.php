<?php
session_start();

// Check if the mode is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mode'])) {
    $_SESSION['mode'] = $_POST['mode']; // Save in session
    header("Location: " . $_SERVER['PHP_SELF']); // Reload to apply changes
    exit();
}

// Set default mode to light if not set
if (!isset($_SESSION['mode'])) {
    $_SESSION['mode'] = 'light';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Customization</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* Reset margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Light Mode */
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
            color: #333;
            transition: all 0.3s ease;
        }

        .header2 {
            width: 100%;
            background: url('image/background.jpg');
            background-size: cover;
            margin-left: 300px;
        }

        .header2 h1 {
            margin-top: 220px;
            margin-left: 410px;
            font-size: 48px;
        }
        .header {
            width: 100%;
            height: 100vh;
            background: #e2e9f7;
        }
        .side-nav {
            width: 310px;
            height: 100%;
            background: #0d74f5;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 30px;
        }
        .logo {
            display: block;
            margin-bottom: 130px;
        }

        .logo-img {
            width: 50px;
            height: auto;
            
        }
        .nav-links {
            list-style: none;
            position: relative;
        }

        .nav-links li {
            padding: 10px 0;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 14px;
            display: flex;
            align-items: center;
        }

        .nav-links li a i {
            font-size: 22px;
            margin-right: 20px;
        }

        .nav-links li:hover a {
            color: #0d74f5;
            transition: 0.3s;
        }
        .active {
            background: #fff;
            width: 100%;
            height: 47px;
            position: absolute;
            left: 0;
            top: 2.6%;
            z-index: -1;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(255, 255, 255, 0.4);
            display: none;
            transition: top 0.5s;
        }

        .nav-links li:hover a {
            color: #0d74f5;
            transition: 0.3s;
        }

        .nav-links li:hover ~ .active {
            display: block;
        }

        .nav-links li:nth-child(1):hover ~ .active {
            top: 2.6%;
        }

        .nav-links li:nth-child(2):hover ~ .active {
            top: 27.6%;
        }

        .nav-links li:nth-child(3):hover ~ .active {
            top: 52.6%;
        }

        .nav-links li:nth-child(4):hover ~ .active {
            top: 77.6%;
        }

        /* Dark Mode */
        .dark-mode {
            background-color: #222 !important;
            color: #f5f5f5 !important;
        }

        .dark-mode .side-nav {
            background: #333 !important;
        }

        .dark-mode .header2 {
            background: #444 !important;
        }

        .dark-mode .nav-links li a {
            color: #ddd !important;
        }

        /* Mode Select Styling */
        .mode-select {
            position: fixed;
            top: 60%;
            right: 580px;
            transform: translateY(-50%);
            z-index: 1000;
            padding: 10px;
        }

        .mode-select label {
            margin-right: 10px;
            font-size: 32px;
        }
        .mode-select select{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 28px;
            color: rgb(32, 34, 36);
            padding: 2px 15px 4px 15px;
        }

        .mode-select button {
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 16px;
            background-color:rgb(69, 133, 210);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 180px;
            
        }

        .mode-select button:hover {
            background-color:rgb(107, 152, 208);
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 50px;
            cursor: pointer;
            font-size: 24px;
            color: #333;
        }

        .dark-mode .theme-toggle {
            color: #f5f5f5;
        }
    </style>
</head>
<body class="<?php echo ($_SESSION['mode'] == 'dark') ? 'dark-mode' : ''; ?>">

    <div class="side-nav">
        <a href="#" class="logo">
            <img src="image/home.png" class="logo-img" alt="Logo">
        </a>
        <ul class="nav-links">
        <li><a href="settings.php"><i class='bx bxs-user-account'></i><p>Account Settings</p></a></li>
        <li><a href="privacy.php"><i class='bx bx-shield-quarter'></i><p>Privacy & Security</p></a></li>
            <li><a href="theme1.php"><i class='bx bxs-palette'></i><p>Theme & Customization</p></a></li>
            <li><a href="look_profile.php"><i class='bx bx-arrow-back'></i><p>Back</p></a></li>
            <div class="active"></div>
        </ul>
    </div>

    <div class="theme-toggle" onclick="toggleMode()">
        <i class="bx <?php echo ($_SESSION['mode'] == 'dark') ? 'bx-sun' : 'bx-moon'; ?>" id="theme-icon"></i>
    </div>

    <div class="header2">
        <h1>Change Theme</h1>
        <div class="mode-select">
            <form method="POST">
                <label for="mode">Select Mode:</label><br><br>
                <select name="mode" id="mode">
                    <option value="light" <?php echo ($_SESSION['mode'] == 'light') ? 'selected' : ''; ?>>Light Mode</option>
                    <option value="dark" <?php echo ($_SESSION['mode'] == 'dark') ? 'selected' : ''; ?>>Dark Mode</option>
                </select>
                <br><br>
                <button type="submit">Apply Theme</button>
            </form>
        </div>
    </div>

    <script>
        function toggleMode() {
            const currentMode = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newMode = currentMode === 'dark' ? 'light' : 'dark';

            // Toggle class for dark mode
            document.body.classList.toggle('dark-mode');
            document.querySelector('.side-nav').classList.toggle('dark-mode');
            document.querySelector('.header2').classList.toggle('dark-mode');

            // Change icon
            const themeIcon = document.getElementById('theme-icon');
            themeIcon.classList.toggle('bx-moon');
            themeIcon.classList.toggle('bx-sun');

            // Save mode in session via fetch
            const formData = new FormData();
            formData.append('mode', newMode);

            fetch('', {
                method: 'POST',
                body: formData
            }).then(() => {
                location.reload(); // Reload to apply changes
            });
        }
    </script>

</body>
</html>
