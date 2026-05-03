<?php
include('connect.php');

// Check if the application ID is passed in the URL
if (isset($_GET['id'])) {
    $application_id = $_GET['id'];

    // Prepare and execute the query to fetch the application details
    $stmt = $conn->prepare("SELECT * FROM applications WHERE id = ?");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the application exists
    if ($result->num_rows > 0) {
        $application = $result->fetch_assoc();
    } else {
        echo "Application not found.";
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No application ID provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Confirmation</title>
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f9;
        }
                
                #header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 5px 60px;
                    background: white;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
                    z-index: 999;
                    position: sticky;
                    top: 0;
                    left: 0;
                }
                #navbar {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                #navbar li {
                    list-style: none;
                    padding: 0 30px;
                }
                #navbar li a {
                    text-decoration: none;
                    font-size: 22px;
                    font-weight: 600;
                    color: #1a1a1a;
                    transition: 0.3s ease;
                }
        .main{
            width: 600px;
            background: transparent;
            border: none;
            backdrop-filter: blur(28px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: black;
            border-radius: 10px;
            padding: 30px 40px;
            margin-left:100px;
        }
    </style>
</head>
<body>
<section id="header">
        <div>
            <ul id="navbar">
                <li><a  href="joblooking.php">Back to Home</a></li>
            </ul>
        </div>
    </section>
        <section>
    <div class="main">
    <h1>Application Confirmation</h1><br>
    
    <p><strong>First Name:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo htmlspecialchars($application['first_name']); ?></p><br>
    <p><strong>Last Name:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($application['last_name']); ?></p><br>
    <p><strong>Contact Number:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($application['contact_number']); ?></p><br>
    <p><strong>Email:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($application['email']); ?></p><br>
    <p><strong>Location:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo htmlspecialchars($application['location']); ?></p><br>
    <p><strong>LinkedIn:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($application['linkedin']); ?></p><br>
    <p><strong>GitHub:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo htmlspecialchars($application['github']); ?></p><br>
    <p><strong>Resume:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo htmlspecialchars($application['resume']); ?>" target="_blank">View Resume</a></p>
</div>
    </section>
</body>
</html>
