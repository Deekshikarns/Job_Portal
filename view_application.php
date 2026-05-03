<?php
include('connect.php');
session_start();

if (isset($_GET['id'])) {
    $application_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM applications WHERE id='$application_id'";
    $result = mysqli_query($conn, $query);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Application Details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color:rgb(219, 219, 235);
            }
            #header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 30px;
                background: #fff;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                position: sticky;
                top: 0;
                z-index: 999;
            }
            #navbar {
                display: flex;
                align-items: center;
            }
            #navbar li {
                list-style: none;
                margin-left: 20px;
            }
            #navbar li a {
                text-decoration: none;
                font-size: 18px;
                font-weight: 600;
                color: #1a1a1a;
                transition: color 0.3s ease;
            }
            #navbar li a:hover {
                color: #007bff;
            }
            section {
                max-width: 800px;
                margin: 40px auto;
                padding: 20px;
                background: url(image/ba1.jpg);
                background-size: cover;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }
            h2, h3 {
                color: #333;
            }
            p {
                margin: 10px 0;
                line-height: 1.6;
            }
            a {
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
            select, button {
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            button {
                background-color: #28a745;
                color: white;
                cursor: pointer;
                border: none;
            }
            button:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
    <section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="application.php">Back to Home</a></li>
            </ul>
        </div>
    </section>
    <section>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>Applicant Details</h2>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
            echo "<p><strong>Contact Number:</strong> " . htmlspecialchars($row['contact_number']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
            echo "<p><strong>LinkedIn:</strong> <a href='" . htmlspecialchars($row['linkedin']) . "' target='_blank'>" . htmlspecialchars($row['linkedin']) . "</a></p>";
            echo "<p><strong>GitHub:</strong> <a href='" . htmlspecialchars($row['github']) . "' target='_blank'>" . htmlspecialchars($row['github']) . "</a></p>";

            // Handle resume link
            if (!empty($row['resume']) && file_exists($row['resume'])) {
                echo "<p><strong>Resume:</strong> <a href='" . htmlspecialchars($row['resume']) . "' target='_blank'>View Resume</a></p>";
            } else {
                echo "<p><strong>Resume:</strong> Not available</p>";
            }

            // Form to update status
            echo "<h3>Update Status</h3>";
            echo "<form action='application_status.php' method='POST'>
                    <input type='hidden' name='application_id' value='" . htmlspecialchars($row['id']) . "'>
                    <select name='status' required>
                        <option value='' disabled selected>--- Select the status ---</option>
                        <option value='Selected for process'>Selected for process</option>
                        <option value='Under Review'>Under Review</option>
                        <option value='Rejected'>Rejected</option>
                    </select>
                    <button type='submit'>Update Status</button>
                  </form>";
        } else {
            echo "<p>Application not found.</p>";
        }
        ?>
    </section>
    </body>
    </html>
    <?php
} else {
    echo "<p>Invalid request.</p>";
}
?>
