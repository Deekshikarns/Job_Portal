<?php
// Database credentials
include 'connect.php';

// Handle the form submission for email
if (isset($_POST['submit_email'])) {
    $email = $_POST['email'];

    // Query to check if email exists in the database
    $query = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Store email in session to pass it to the next page
        $_SESSION['email'] = $email;
    } else {
        echo "<p>Email not found!</p>";
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
                <input type="email" name="email" id="email" placeholder="Email*" required>
            </div>
            <button type="submit" class="BTN" name="submit_email">Next</button>
        </form>

        <!-- Password form that will be displayed after email submission -->
        <div id="passwordForm" style="display: none;">
            <form method="POST" action=" new.php">
                <div class="main">
                    <input type="password" name="password" placeholder="Password*" required>
                </div>
                <button type="submit" class="BTN" name="login">Login</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to show the password field after email is entered
        const emailForm = document.getElementById("emailForm");
        const passwordForm = document.getElementById("passwordForm");
        const submitButton = emailForm.querySelector("button"); // Get the Next button

        emailForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
            const email = document.getElementById("email").value;

            // Check if the email exists (if found, show the password form)
            if (email) {
                passwordForm.style.display = "block"; // Show the password field
                submitButton.style.display = "none"; // Hide the Next button
            }
        });
    </script>
</body>
</html>
