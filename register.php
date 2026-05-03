<?php 
session_start();
include("connect.php"); // Include your database connection file

if (isset($_POST["submit"])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $job = $_POST['job']; 

    // Check database connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare and bind SQL statement for user registration
        // Add 'job' column to the query
        $stmt = $conn->prepare("INSERT INTO signup (name, email, password, job) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $job); // Include job_type in binding
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<script type='text/javascript'> alert('Registration successful!')</script>";
            
            // Redirect based on the selected job option
            if ($job === "joblooking") {
                header("Location: joblooking.php");
                exit();
            } elseif ($job === "jobhiring") {
                header("Location: jobhiring.php");
                exit();
            } else {
                echo "<script type='text/javascript'> alert('Invalid job selection')</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Error during registration')</script>";
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("image/job.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .xyz {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(28px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: white;
            border-radius: 10px;
            padding: 30px 40px;
        }
        .xyz h1 {
            font-size: 42px;
            text-align: center;
            color: #ffffff;
            font-weight: bold;
        }
        .xyz .main {
            width: 100%;
            height: 60px;
            margin: 30px 0;
        }
        .main input {
            width: 100%;
            height: 80%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            font-size: 18px;
            color: rgb(32, 34, 36);
            padding: 2px 15px 4px 15px;
        }
        .main input::placeholder {
            color: #081b29;
        }
        .xyz .BTN {
            width: 100%;
            height: 45px;
            background: rgb(253, 213, 159);
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        .home {
            display: flex;
            align-items: center;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .home label {
            color: #081b29;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .home input[type="radio"] {
            appearance: none;
            width: 16px;
            height: 16px;
            border: 2px solid #081b29;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            outline: none;
            background-color: white;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }
        .home input[type="radio"]:checked {
            background-color: #088178;
            border-color: #088178;
        }
        .home input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="xyz">
        <h1>Register</h1>
        <form method="POST">
            <div class="main">
                <input type="text" name="name" id="name" placeholder="Name" required>
            </div>
            <div class="main">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="main">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="home">
                <label>Looking for a job? 
                    <input type="radio" name="job" value="joblooking" required>
                </label>
            </div>
            <br><br>
            <div class="home">
                <label>Hiring someone? 
                    <input type="radio" name="job" value="jobhiring" required>
                </label>
            </div>
            <br>
            <button type="submit" class="BTN" name="submit">SIGN UP</button>
        </form>
    </div>
</body>
</html>
