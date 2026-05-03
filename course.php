<?php
include('connect.php');

// Handle Course Addition
if (isset($_POST['add_course'])) {
    $course_name = trim($_POST['course_name']);
    $duration = intval($_POST['duration']);
    $sql = "INSERT INTO courses (course_name, duration) VALUES ('$course_name', $duration)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Course '$course_name' added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
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

        .settings-form h2 {
            margin-top: 100px;
            margin-left: 420px;
            font-size: 48px;
        }

        .settings-form .pro2 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .settings-form .pro2 .pro {
            width: 350px;
            border: 2px solid black;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 10px;
        }

        .settings-form .pro2 .pro label{
            font-size: 32px;
        }
        .settings-form .pro2 .pro input{
            width: 70%;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
        }

        .settings-form .pro2 .pro .btn {
            width: 50%;
            height: 35px;
            background-color: rgb(53, 69, 234);
            border: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            font-size: 18px;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            margin-top: 10px;
        }
       
    </style>
</head>
<body>
<div class="header">
        <div class="side-nav">
            <a href="#" class="logo"><img src="image/home.png" class="logo-img"></a>
            <ul class="nav-links">
                <li><a href="course.php"><i class='bx bxs-bookmark-alt-plus'></i><p>Add Courses</p></a></li>
                <li><a href="add.php"><i class='bx bxs-add-to-queue'></i><p>Add Questions</p></a></li>
                <li><a href="home1.php"><i class='bx bx-arrow-back'></i><p>Back</p></a></li>
                
                <div class="active"></div>
            </ul>
        </div>
        <div class="main-content">
        <div class="settings-form">
    <h2>Add a Course</h2><br><br>
    <div class="pro2">
    <div class="pro">
    <form method="post">
    <input type="number" name="duration" min="1" required><br><br>
        <label>Course Name:</label><br><br>
        <input type="text" name="course_name" required><br><br>
    
        <button type="submit" class="btn" name="add_course">Add Course</button>
    </form>
    </div> </div>
    </div> 
    </div>
</body>
</html>
