<?php
include('connect.php');
session_start();
$image_file = "";
$company = "";
$jobname = "";
$salary = "";
$experience="";

$query = "SELECT * FROM jobhiring WHERE jobname = 'software developer'";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Jobs</title>
    <style>
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
        #hero {
            background-image: url("image/professional.jpg");
            height: 60vh;
            width: 100%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #hero .register h1 {
            font-size: 64px;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }
        .job-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .job-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .job-card img {
            width: 100%;
            height: 150px;
            object-fit: contain;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .job-card h3, .job-card p {
            margin: 8px 0;
        }
        .job-card .salary {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="joblooking.php">Home</a></li>
                <li><a href="jobhiring.php">Post a Job</a></li>
                <li ><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>
    <section id="hero">
        <div class="register">
            <h1>SOFTWARE DEVELOPER</h1>
        </div>
    </section>
    <section class="job-container">
        <?php
        $query_row = mysqli_query($conn, $query); 

        if (mysqli_num_rows($query_row) > 0) {
            while ($res = mysqli_fetch_assoc($query_row)) {
                ?>
                <div class="job-card">
                    <img src="<?php echo htmlspecialchars($res['image_file']); ?>" style="width: 60px; height: 50px;" alt="Company Logo">
                    
                    <h3>
                        <a href="softwaredetailslooking.php?job_id=<?php echo htmlspecialchars($res['id']); ?>" 
                           style="text-decoration: none; color: inherit;">
                           <?php echo htmlspecialchars($res['jobname']); ?>
                        </a>
                    </h3>
                    <p><strong>Company:</strong> <?php echo htmlspecialchars($res['company']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($res['location']); ?></p>
                    <p class="salary">Salary:  ₹<?php echo htmlspecialchars($res['salary']); ?></p>
                </div>
                <?php
            }
           } else {
            echo "<p>No jobs available.</p>";
        }
    
        ?>
    </section>
</body>
</html>  