<?php
// Database credentials
include 'connect.php';

// Handle the form submission for email
if (isset($_POST['submit_email'])) {
    // Get form input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $newemail = $_POST['new_email'];

    // Validate the inputs (you can customize the validation)
    if (empty($name) || empty($email) || empty($newemail)) {
        echo "<script type='text/javascript'>alert('All fields are required!'); window.location.href = 'change_email.php';</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
        echo "<script type='text/javascript'>alert('Invalid email format!'); window.location.href = 'change_email.php';</script>";
    } else {
        // Check if the provided name and email exist in the database
        $query = "SELECT * FROM signup WHERE name = ? AND email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the user exists, proceed with updating the email
            $update_query = "UPDATE signup SET email = ? WHERE name = ? AND email = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sss", $newemail, $name, $email);

            if ($update_stmt->execute()) {
                echo "<script type='text/javascript'>alert('Email updated successfully!');</script>";
                header('Location: settings.php');
        exit;
            } else {
                echo "<script type='text/javascript'>alert('Error updating email: " . $update_stmt->error . "'); window.location.href = 'change_email.php';</script>";
            }

            $update_stmt->close();
        } else {
            // If no match found, display a warning message
            echo "<script type='text/javascript'>alert('The provided name and email do not match any records!'); window.location.href = 'change_email.php';</script>";
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('image/employee.jpeg');
            background-size: cover;
        }
        .xyz {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: white;
            border-radius: 10px;
            padding: 30px 40px;
        }
        .main {
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
        .BTN {
            width: 45%;
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
            margin-left: 130px;
        }
    </style>
</head>
<body>
    <div class="xyz">
        <form method="POST" id="emailForm">
        <div class="main">
                <input type="text" name="name" id="name" placeholder="Name*" required>
            </div>
            <div class="main">
                <input type="email" name="email" id="email" placeholder="Email*" required>
            </div>
            <div class="main">
                    <input type="email" name="new_email" placeholder="New_email*" required>
                </div>
            <button type="submit" class="BTN" name="submit_email">Next</button>
    </form>
        
    </div>

   
</body>
</html>
