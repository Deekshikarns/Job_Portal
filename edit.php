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
        header('Location: login.php');
        exit; 
    }
} else {
    header('Location: login.php');
    exit; 
}

if(isset($_POST["submit"])) {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Handle Image Upload
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $target_dir = "uploads/"; // Ensure this directory exists with proper permissions
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Allow only image file types
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if(in_array($imageFileType, $allowed_types)) {
            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Update profile image path in the database
                $update_image_sql = "UPDATE signup SET photo='$target_file' WHERE email='$email'";
                mysqli_query($conn, $update_image_sql);
            } else {
                echo "<script>alert('Error uploading image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid image format. Use JPG, JPEG, PNG, or GIF.');</script>";
        }
    }

    // Update the user table
    $sql = "UPDATE signup SET name='$name', phone_number='$phone_number', age='$age', dob='$dob', gender='$gender', address='$address' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        echo "<script>alert('Profile updated successfully.'); ";
        header('Location: emp_profile.php');
        exit;
    } else {
        echo "<script>alert('Failed to update profile.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("image/ba.jpg");
            background-size: cover;
        }

        .register {
            background: transparent;
            border: 2px solid rgba(255,255,255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px 50px;
            width: 400px;
        }

        .register h1 {
            font-size: 26px;
            color: darkcyan;
            text-align: center;
        }

        .register label {
            font-size: 18px;
            color: black;
        }

        .register input, .register select, .register textarea {
            width: 100%;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            padding: 5px 15px;
            margin-bottom: 10px;
            color: black;
        }

        .register input[type="file"] {
            border: none;
            padding: 5px;
        }

        .register textarea {
            height: 80px;
        }

        .register .btn {
            width: 100%;
            height: 45px;
            background-color: rgb(247, 183, 138);
            border: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            font-size: 18px;
            cursor: pointer;
            font-weight: 600;
            color: black;
            margin-top: 10px;
        }

        .profile-image {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .profile-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid darkcyan;
        }

        .gender-options input {
            width: auto;
            margin-right: 5px;
        }

    </style>
</head>
<body>

    <form method="POST" enctype="multipart/form-data">
        <div class="register">
            <h1>Your Profile</h1>

            <div class="profile-image">
                <img src="<?php echo !empty($fetch_info['photo']) ? $fetch_info['photo'] : 'uploads/default.png'; ?>" alt="Profile Image">
            </div>

            <label>Profile Picture</label><br>
            <input type="file" name="photo" accept="image/*"><br><br>

            <label>Firstname*</label>
            <input type="text" name="name" value="<?php echo $fetch_info['name']; ?>">

            <label>Email*</label>
            <input type="email" name="email" value="<?php echo $fetch_info['email']; ?>" readonly>

            <label>Phone Number*</label>
            <input type="tel" name="phone_number" value="<?php echo $fetch_info['phone_number']; ?>">

            <h2>Complete your profile</h2>

            <label>Age*</label>
            <input type="number" name="age">

            <label>Date of Birth*</label>
            <input type="date" name="dob">

            <label>Gender*</label>
            <div class="gender-options">
                <input type="radio" name="gender" value="Male"> Male
                <input type="radio" name="gender" value="Female"> Female
                <input type="radio" name="gender" value="Other"> Other
            </div>

            <label>Address*</label>
            <textarea name="address" cols="35" rows="5"><?php echo $fetch_info['address']; ?></textarea>

            <button type="submit" class="btn" name="submit">Update</button>
        </div>
    </form>

</body>
</html>
