<?php
session_start();
include("connect.php");
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $fetch_info = mysqli_fetch_assoc($result);
    } else {
        header('Location: change_password.php');
        exit; 
    }
} else {
    header('Location: change_password.php');
    exit; 
}

if(isset($_POST["submit"])) {
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    if($password !== $password1) {
        echo "<script type='text/javascript'> alert('Passwords do not match')</script>";
    } else {
    $sql = "UPDATE signup SET password = '$password' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        echo "<script type='text/javascript'> alert('password updated successfully.')</script>";
        header('Location: settings.php');
        exit;
    } else {
        echo "<script type='text/javascript'> alert('Failed to update profile.')</script>";
    }

    
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            min-height: 100vh;
            background-image: url("image/background.jpg");
            background-size: cover;
        }
        .password {
            color: white;
            text-align: center;
        }

        .strong h1 {
            font-size: 48px;
            color: #43494f;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .strong1 p {
            text-align: center;
            font-size: 34px;
            color: black;
            margin-bottom: 20px;
        }

        hr {
            width: 100%;
            border: 0.5px solid rgba(255, 255, 255, 0.5);
            margin-bottom: 10px;
        }
        .strong2 {
            width: 420px;
            color: white;
            border-radius: 10px;
            padding: 30px 40px;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .main {
            width: 100%;
            height: 60px;
            margin: 30px 0;
        }
        .main input {
            width: 100%;
            height: 90%;
            background: transparent;
            outline: none;
            border: 2px solid rgba(9, 6, 6, 0.2);
            border-radius: 40px;
            font-size: 18px;
            color: rgb(32, 34, 36);
            padding: 2px 15px 4px 15px;
        }
        .main input::placeholder {
            color: #081b29;
        }
        .strong3 p {
            font-size: 14px;
            color: black;
        }
        .BTN {
            width: 50%;
            height: 45px;
            background: rgb(7, 38, 193);
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            margin-left: 220px;
        }
    </style>
</head>
<body>
    <div class="password">
        <div class="strong">
            <h1>Change Password</h1>
        </div><hr>
        <div class="strong1">
            <p>Choose a strong password and don't reuse it for other accounts.</p>
        </div>
        <div class="strong2">
        <form method="POST">
            <div class="main">
                <input type="password" name="password" id="password" placeholder="New password" required>
            </div>
            <div class="strong3">
                <p><strong>Password strength:</strong></p>
                <p>Use at least 8 characters. Don’t use a password from another site, or something too obvious like your pet’s name.</p>
            </div>
            <div class="main">
                <input type="password" name="password1" id="password1" placeholder="Confirm new password" required>
            </div>
            
            <button type="submit" class="BTN" name="submit">Change Password</button>
        </form>
        </div>
    </div>
</body>
</html>
