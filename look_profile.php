<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee_Profile</title>
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

        
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }

        .settings-form {
            
            padding: 20px;
            border-radius: 8px;
           
        }

        .settings-form h2 {
            margin-bottom: 100px;
            margin-top: 50px;
            margin-left: 520px;
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

        .settings-form .pro2 .pro a {
            font-size: 18px;
            text-decoration: none;
            color: black;
            display: block;
            padding: 10px;
            transition: all 0.3s ease;
        }

        /* Animation on hover */
        .settings-form .pro2 .pro:hover {
            transform: scale(0.95);
            margin-top: 10px;
        }

        .settings-form .pro2 .pro a:hover {
            color: #0d74f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="side-nav">
            <a href="#" class="logo"><img src="image/home.png" class="logo-img"></a>
            <ul class="nav-links">
                <li><a href="look_profile.php"><i class='bx bxs-user-circle'></i><p>Profile</p></a></li>
                <li><a href="application2.php"><i class='bx bxs-file-blank'></i><p>Applications</p></a></li>
                <li><a href="settings1.php"><i class='bx bxs-cog' ></i><p>Settings</p></a></li>
                <li><a href="joblooking.php"><i class='bx bx-arrow-back'></i><p>Back</p></a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i><p>Logout</p></a></li>
                <div class="active"></div>
            </ul>
        </div>

        <div class="main-content">
            <div class="settings-form">
                <h2>Profile</h2>
                <div class="pro2">
                <div class="pro">
                    <a href="edit1.php">Edit Profile</a>
                </div>
                </div>
                <br><br>
                <div class="pro2">
                <div class="pro">
                    <a href="view2.php">View Profile</a>
                </div> </div>
                <br><br>
                
                     
                
        </div>
    </div>
</body>
</html>