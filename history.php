<?php
include('connect.php');
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM signup WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    exit;
}

$user = mysqli_fetch_assoc($result);

// Get user_id from the fetched user data, not from session
$user_id = $user['id'];   // Assuming the user is logged in

// Fetch quiz history
$sql = "SELECT qh.*, c.course_name 
        FROM quiz_history qh
        JOIN courses c ON qh.course_id = c.id
        WHERE qh.user_id = '$user_id'
        ORDER BY qh.taken_at DESC";

$history = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz History</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        table {
            width: 40%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            font-family: 'Poppins', sans-serif;
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
            top: 35.93%;
        }
        .nav-links li:nth-child(3):hover ~ .active{
            top: 69.26%;
        }
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }

    </style>
</head>
<body>
<div class="header">
        <div class="side-nav">
            <a href="#" class="logo"><img src="image/home.png" class="logo-img"></a>
            <ul class="nav-links">
                <li><a href="assignment.php"><i class='bx bxs-bookmark-alt-plus'></i><p>Assignments</p></a></li>
                <li><a href="history.php"><i class='bx bx-history' ></i><p>History</p></a></li>
                <li><a href="joblooking.php"><i class='bx bx-arrow-back'></i><p>Back</p></a></li>
                
                <div class="active"></div>
            </ul>
        </div>
    <h2 style="text-align: center;">Quiz History</h2>
    <table>
        <tr>
            <th>Course</th>
            <th>Score</th>
            <th>Total Questions</th>
            <th>Percentage</th>
            <th>Date Taken</th>
        </tr>
        <?php while ($row = $history->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['course_name']) ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['total_questions'] ?></td>
                <td><?= round($row['percentage'], 2) ?>%</td>
                <td><?= $row['taken_at'] ?></td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
