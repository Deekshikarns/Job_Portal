<?php
include('connect.php');
session_start();

if (isset($_GET['job_id'])) {
    $job_id = mysqli_real_escape_string($conn, $_GET['job_id']);
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
                #hero {
                    background-image: url("image/application.jpg");
                    height: 40vh;
                    width: 100%;
                    background-size: cover;
                    background-position: center;
                    display: flex;
                   
                }
              
                .container {
                    max-width: 1000px;
                    margin: 20px auto;
                    background: white;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom:350px;
                    position: relative;
                    top:-120px;
                    margin-left: 90px;
                }
                .job-header {
                    display: flex;
                    align-items: center;
                    margin-bottom: 20px;
                    margin-left:50px;
                }
                .job-header img {
                    width: 80px;
                    height: 80px;
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
                    max-width:900px;
                    margin-left:50px;
                }

                .job-details p {
                    padding-left: 20px;
                    margin: 10px 0;
                }
                .job-details1,
                .job-details2,
                .job-details3,
                .job-details4{
                    flex: 1; 
                    line-height: 1.6;
                    color: #555;
                    border-radius: 8px;
                    border: 2px solid black;
                    padding: 10px;
                    max-width:900px;
                    margin-left:50px;
                }

                .job-details1 p,
                .job-details2 p,
                .job-details3 p,
                .job-details4 p {
                    padding-left: 20px;
                    margin: 10px 0;
                }
                .job-detail{
                   
                    color: #555;
                    border-radius: 5px;
                    border: 1px solid black;
                    padding: 10px;
                    max-width:300px;
                    margin-left:25px;
                }
                .job-detail p{
                    font-size: 18px;
                    margin-left:-20px;
                }
                .job-detail strong{
                    color: black;
                    margin-left:-10px;
                }
                .job-details strong {
                    color: #333;
                    padding-left: 5px;
                }

                .job-box {
                    max-width: 300px; 
                    color: #555;
                    border-radius: 8px;
                    border:none;
                    padding: 10px;
                    margin-left:1150px;  
                    position: relative; 
                    bottom: 1650px;  
                    background:white;              
                }
                .job-box .btn {
                    width: 90%;
                    height: 45px;
                    background: rgb(253, 213, 159);
                    border: none;
                    outline: none;
                    border-radius: 5px;
                    box-shadow: 0 0 10px  rgba(0,0,0, .1);
                    cursor: pointer;
                    font-size: 16px;
                    color: #333;
                    font-weight: 600;
                    margin-left:10px;
                }
                .job-box p {
                    padding-left: 20px;
                    color: #333;
                }

                .job-box strong {
                    color: #333;
                    padding-left: 5px;
                }
                .job-detail #read-more-link {
                    color: #5E99F8;
                    cursor: pointer;
                    text-decoration: None;
                }
                .job-detail #read-more-link:hover {
                    color: #0056b3;
                }


               
               
                
            </style>
        </head>
        <body>
        <section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a  href="applooking.php">Back to Home</a></li>
            </ul>
        </div>
    </section>
    <section id="hero">
        <div class="register">
            
        </div>
    </section>
    <section>
            <div class="container">
                <div class="job-header">
                    <img src="<?php echo htmlspecialchars($job['image_file']); ?>" alt="Company Logo">
                    <div>
                    <h1><?php echo htmlspecialchars($job['jobname']); ?></h1>
                        <p><?php echo htmlspecialchars($job['company']); ?></p>
                        
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div> 
                    <p><strong>Location:</strong><br> <?php echo htmlspecialchars($job['location']); ?></p>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>
                    <p class="salary"><strong>Cost to Company:</strong><br>CTR: INR     <?php echo htmlspecialchars($job['salary']); ?></p>
                    </div>
                </div>
                
                <div class="job-details">
                    <p><strong>Bond : </strong> <?php echo htmlspecialchars($job['bond']); ?></p>
                </div><br>
                
                <div class="job-details1">
                    <p><strong>Eligible Courses : </strong><?php echo nl2br(htmlspecialchars($job['courses'])); ?></p>
                </div><br>
                <div class="job-details4">
                <p><strong>Category:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Nature:</strong><br> <?php echo htmlspecialchars($job['category']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <?php echo htmlspecialchars($job['nature']); ?></p>
                </div><br>
                <div class="job-details2">
                    <p><strong>Eligible Criteria : </strong> <?php echo nl2br(htmlspecialchars($job['criteria'])); ?></p>
                </div><br>
               
                <div class="job-details3">
                    <p><strong>Job Description:</strong><br> <?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
                </div><br>
                </div>
                <div class="job-box">  
                <form action="apply.php" method="post">
                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['id']); ?>">
                    <button type="submit" class="btn">Apply Now</button>
                    <p>Registeration Schedule</p>
                    <div class="job-detail">
                    <p>opens: <?php echo date('d/m/Y', strtotime($job['form_date'])); ?></p>
                    <p>Closes: <?php echo date('d/m/Y', strtotime($job['submission'])); ?></p>
                        <p><strong>Registration Details</strong></p>
                        <p>Registration Process: <span id="read-more-text" style="display: none;"><br><br>
                            step1: Click on Apply Now<br><br>
                            step2: Fill the details<br><br>
                            step3: Submit
                        </span>
                        <a href="#" id="read-more-link" onclick="toggleReadMore(event)">...more</a>
                        </p>
                    </div>

                </div>
            </section>
            
                <script>
                    function toggleReadMore(event) {
                        event.preventDefault(); // Prevent default anchor behavior
                        const moreText = document.getElementById("read-more-text");
                        const linkText = document.getElementById("read-more-link");

                        if (moreText.style.display === "none") {
                            moreText.style.display = "inline"; // Show the steps
                            linkText.textContent = "...less"; // Update link text
                        } else {
                            moreText.style.display = "none"; // Hide the steps
                            linkText.textContent = "... more"; // Reset link text
                        }
                    }
                </script>
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
