<?php
include('connect.php');
session_start();

if (isset($_GET['job_id'])) {
    $job_id = mysqli_real_escape_string($conn, $_GET['job_id']);
    $query = "SELECT * FROM applications WHERE job_id='$job_id'";
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
                background: url(image/ba1.jpg);
                background-size: cover;
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
                background: url(image/ba2.jpg);
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
                <li><a href="home1.php">Back to Home</a></li>
            </ul>
        </div>
    </section>
    <section>
        <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%;'>";
        echo "<tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Actions</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['contact_number'] . "</td>";
            echo "<td>
                    <a href='view_application.php?id=" . $row['id'] . "'><button>View</button></a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No applications found for this job.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
