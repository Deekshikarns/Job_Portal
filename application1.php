<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Fetch user info based on the email
    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $fetch_info = mysqli_fetch_assoc($result);
        $user_id = $fetch_info['id']; // Store the user ID for filtering jobs
    } else {
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}

// Fetch jobs posted by the logged-in user
$sql = "SELECT * FROM jobhiring WHERE user_id = '$user_id'";
$jobs_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Posted Jobs</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
         *{
            margin: 0;
            padding: 0;
            box-shadow: border-box;
            font-family: 'Poppins',sans-serif;
        }

        .header{
            width: 100%;
            height: 100vh;
            background:url('image/ba1.jpg');
            background-size: cover;
        }
        .side-nav{
            width: 250px;
            height: 100%;
            background: #0d74f5;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 30px;
        }
        .logo{
            display:block;
            margin-bottom:130px;
        }
        .logo-img {
            width: 50px; /* Reduce from 50px to 30px */
            height: auto; /* Maintain aspect ratio */
        }
        .nav-links{
            list-style: none;
            position: relative;
        }
        .nav-links li{
            padding: 10px 0;
        }
        .nav-links li a{
            color:#fff;
            text-decoration: none;
            padding: 10px 14px;
            display: flex;
            align-item: center;
        }
        .nav-links li a i{
            font-size:22px;
            margin-right: 20px;
        }
        .active{
            background: #fff;
            width: 100%;
            height: 47px;
            position: absolute;
            left: 0;
            top: 2.6%;
            z-index: -1;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(255, 255, 255, 0.4);
            display:none;
            transition: top 0.5s;
        }
        .nav-links li:hover a{
            color: #0d74f5;
            transition: 0.3s;
        }
        .nav-links li:hover ~ .active{
            display: block;
        }
        .nav-links li:nth-child(1):hover ~ .active{
            top:2.6%;
        }
        .nav-links li:nth-child(2):hover ~ .active{
            top: 22.6%;
        }
        .nav-links li:nth-child(3):hover ~ .active{
            top: 42.6%;
        }
        .nav-links li:nth-child(4):hover ~ .active{
            top: 62.6%;
        }
        .nav-links li:nth-child(5):hover ~ .active{
            top: 82.6%;
        }
        .main {
    margin-left: 280px;
    padding: 20px;
    width: calc(100% - 280px);
}

.settings-form {
   
    padding: 30px;
   
}

.settings-form h2 {
    margin-bottom: 40px;
    font-size: 32px;
    text-align: center;
    color: #333;
}

.settings-form .pro2 {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.settings-form .pro2 .pro {
    width: 100%;
    border: 2px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.settings-form .pro2 .pro table {
    width: 100%;
    border-collapse: collapse;
}

.settings-form .pro2 .pro table th,
.settings-form .pro2 .pro table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.settings-form .pro2 .pro table th {
    background-color: #f1f1f1;
}

.settings-form .pro2 .pro table td button {
    background-color:rgb(0, 66, 147);
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.settings-form .pro2 .pro table td button:hover {
    background-color: #084a8b;
}
.settings-form .pro2 .pro:hover {
    transform: scale(0.95);
    margin-top: 10px;
}
       
    </style>
</head>
<body>
<div class="header">
        <div class="side-nav">
            <a href="#" class="logo"><img src="image/home.png" class="logo-img"></a>
            <ul class="nav-links">
                <li><a href="emp_profile.php"><i class='bx bxs-user-circle'></i><p>Profile</p></a></li>
                <li><a href="application1.php"><i class='bx bxs-file-blank'></i><p>Applications</p></a></li>
                <li><a href="settings.php"><i class='bx bxs-cog' ></i><p>Settings</p></a></li>
                <li><a href="home1.php"><i class='bx bx-arrow-back'></i><p>Back</p></a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i><p>Logout</p></a></li>
                <div class="active"></div>
            </ul>
        </div>
        <div class="main">
        <div class="settings-form">
    <h2>Your Job Posts</h2>
    <div class="pro2">
    <div class="pro">
    <table border="1" >
        <tr>
            <th>Job Name</th>
            <th>Company</th>
            <th>Salary</th>
            <th>Vacancies</th>
            <th>Nature</th>
            <th>Submission Date</th>
            <th>Applications</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($jobs_result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['jobname']) ?></td>
                <td><?= htmlspecialchars($row['company']) ?></td>
                <td><?= htmlspecialchars($row['salary']) ?></td>
                <td><?= htmlspecialchars($row['vacancies']) ?></td>
                <td><?= htmlspecialchars($row['nature']) ?></td>
                <td><?= htmlspecialchars($row['submission']) ?></td>
                <td>
                    <!-- Button to view applications for the current job -->
                    <form action="application.php" method="get">
                        <input type="hidden" name="job_id" value="<?= $row['id'] ?>">
                        <button type="submit">View Applications</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
        </div>
    </div>
        </div>
</body>
</html>

<?php
mysqli_free_result($jobs_result);
mysqli_close($conn);
?>
