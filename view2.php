<?php
session_start();
include("connect.php");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("image/ba.jpg");
            background-size: cover;
        }

        .profile-container {
            background: transparent;
            border: 2px solid rgba(255,255,255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px 50px;
            width: 400px;
            text-align: center;
        }

        .profile-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid darkcyan;
        }

        .profile-container h1 {
            font-size: 26px;
            color: darkcyan;
        }

        .profile-details p {
            font-size: 18px;
            color: black;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgb(247, 183, 138);
            border: none;
            border-radius: 40px;
            font-size: 18px;
            cursor: pointer;
            font-weight: 600;
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h1><i class='bx bx-arrow-back' onclick="window.location.href='look_profile.php'"></i>Your Profile</h1>
    <div class="profile-image">
        <img src="<?php echo !empty($user['photo']) ? $user['photo'] : 'uploads/default.png'; ?>" alt="Profile Image">
    </div>
    <div class="profile-details">
        <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user['phone_number']; ?></p>
        <p><strong>Age:</strong> <?php echo $user['age']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
        <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
    </div>
    
</div>

</body>
</html>
