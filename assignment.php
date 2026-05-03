<?php
include('connect.php');

// Fetch all courses including duration
$courses = $conn->query("SELECT id, course_name, duration FROM courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .course-box {
            border: 2px solid #333;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            width: 400px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .start-btn {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .start-btn:hover {
            background-color: #0056b3;
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

        .settings-form {
            
            padding: 20px;
            border-radius: 8px;
           
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
        <div class="main-content">
        <div class="settings-form">
    <h2>Select a Course to Start the Quiz</h2>

    <div style="display: flex; flex-wrap: wrap;">
        <?php while ($row = $courses->fetch_assoc()) { ?>
            <div class="course-box">
                <h3><?= $row['course_name'] ?></h3><br>
                <p><strong>Duration:</strong> <?= $row['duration'] ?> minutes</p>
                <form method="post" action="next.php">
                    <input type="hidden" name="course_id" value="<?= $row['id'] ?>"><br>
                    <button type="submit" class="start-btn">Start Quiz</button>
                </form>
            </div>
        <?php } ?>
    </div>
    </div> 
    </div>
</body>
</html>
