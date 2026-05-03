<?php
include('connect.php');
session_start();

if (isset($_GET['job_id'])) {
    $job_id = mysqli_real_escape_string($conn, $_GET['job_id']);

    // Query to fetch details for the selected job
    $query = "SELECT * FROM jobhiring WHERE id='$job_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Job Details</title>
            <style>
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
                .container {
                    max-width: 1600px;
                    margin: 20px auto;
                    background: white;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom:350px;
                }
                .job-header {
                    display: flex;
                    align-items: center;
                    margin-bottom: 20px;
                }
                .job-header img {
                    width: 120px;
                    height: 120px;
                    object-fit: cover;
                    border-radius: 8px;
                    margin-right: 20px;
                }
                .job-header h1 {
                    font-size: 24px;
                    color: #333;
                    margin: 0;
                }
                .job-header p {
                    font-size: 16px;
                    color: #777;
                    margin: 5px 0 0;
                }
                .job-details {
                    flex: 1; 
                    line-height: 1.6;
                    color: #555;
                    border-radius: 8px;
                    border: 2px solid black;
                    padding: 10px;
                    max-width:800px;
                }

                .job-details p {
                    padding-left: 20px;
                    margin: 10px 0;
                }

                .job-details strong {
                    color: #333;
                    padding-left: 5px;
                }

                .job-box {
                    max-width: 400px; 
                    color: #555;
                    border-radius: 8px;
                    border: 2px solid black;
                    padding: 10px;
                    margin-left:1000px;
                    position: relative; 
                    top: -680px; 
                }

                .job-box p {
                    padding-left: 20px;
                    color: #333;
                }

                .job-box strong {
                    color: #333;
                    padding-left: 5px;
                }

                .job-box .salary {
                    color: green;
                    font-weight: bold;
                    font-size: 18px;
                }
                .form-container {
                    max-width: 880px;
                    margin-top: 20px;
                    padding: 20px;
                    border: 2px solid black;
                    border-radius: 8px;
                   
                    margin-left:50px;   
                }
                .form-container label {
                    font-size: 16px;
                    font-weight: bold;
                    color: #333;
                    margin-bottom: 5px;
                }
                .form-container input{
                    width: 40%;
                    height: 80%;
                    margin-top: 10px;
                    font-size: 16px;
                    border: 2px solid black;
                    border-radius: 5px;
                    padding: 10px 15px 10px 15px;
                }
                .form-container textarea{
                    width: 60%;
                    margin-top: 10px;
                    padding: 10px;
                    font-size: 16px;
                    border: 2px solid black;
                    border-radius: 5px;
                    padding: 10px 15px 10px 15px;
                }
                .form-container button {
                    width: 30%;
                    height: 45px;
                    background: rgb(253, 213, 159);
                    border: none;
                    outline: none;
                    border-radius: 40px;
                    box-shadow: 0 0 10px  rgba(0,0,0, .1);
                    cursor: pointer;
                    font-size: 16px;
                    color: #333;
                    font-weight: 600;
                    margin-left: 300px;
                }
                
                
                
            </style>
        </head>
        <body>
        <section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a  href="front.php">Back to Home</a></li>
                <li><a href="application.php?job_id=<?php echo $job_id; ?>">Applications</a></li>
            </ul>
        </div>
    </section>
            <div class="container">
                <div class="job-header">
                    <img src="<?php echo htmlspecialchars($job['image_file']); ?>" alt="Company Logo">
                    <div>
                        <h1><?php echo htmlspecialchars($job['jobname']); ?></h1>
                        <p>Posted by: <?php echo htmlspecialchars($job['company']); ?></p>
                    </div>
                </div>
                <div class="job-details">
                    <p><strong>Job Description:</strong><br><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
                </div>
                <div class="job-box">
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($job['category']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                    <p><strong>Nature:</strong> <?php echo htmlspecialchars($job['nature']); ?></p>
                    <p class="salary"><strong>Salary:</strong> ₹<?php echo htmlspecialchars($job['salary']); ?></p>
                    <p><strong>Last submission date:</strong> <?php echo htmlspecialchars($job['submission']); ?></p>
                </div>
                <div class="form-container">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $job_id = $_POST['job_id'];
                        $experience = $_POST['experience'];
                        $bond = $_POST['bond'];
                        $course = $_POST['course'];
                        $criteria = $_POST['criteria'];
                        $query = "UPDATE jobhiring SET experience = '$experience',bond = '$bond',courses = '$course',criteria = '$criteria' WHERE id = '$job_id'";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            echo "<script type='text/javascript'> alert('Successful...')</script>";
                        } else {
                            echo "<script type='text/javascript'> alert('Failed to post the job. Please try again.');</script>";
                            echo "Error: " . mysqli_error($conn);
                        }
                    }
                    ?>
                    <h2>Specify Experience </h2>
                    <form  method="POST" >
                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                        
                        <label for="experience">Required Experience (in years)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="Bond">Bond Details</label><br>
                        <input type="number" id="experience" name="experience" min="0" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    
                        <input type="text" name="bond"><br><br>

                        <label for="course">Eligible Courses</label><br>
                        <textarea type="text" name="course" rows="4" cols="50"></textarea><br><br>

                        <label for="criteria">Eligible Criteria</label><br>
                        <textarea type="text" name="criteria" rows="4" cols="50"></textarea><br><br>
                        
                        <button type="submit">Submit Details</button>
                    </form>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Job not found.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
