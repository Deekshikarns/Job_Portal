<?php
include('connect.php');
session_start();

if (isset($_GET['resume_id'])) {
    $resume_id = $_GET['resume_id'];

    // SQL Query to join all relevant tables
    $query = "
        SELECT 
            resume.*, 
            education.course, 
            education.institute, 
            education.year_of_graduation,
            experience.title AS experience_title, 
            experience.company, 
            experience.experience,
            projects.title AS project_title, 
            projects.description, 
            DATE_FORMAT(projects.start_date, '%Y') AS start_year, 
            DATE_FORMAT(projects.end_date, '%Y') AS end_year,
            projects.skills,
            projects.projectlink, 
            skills.skill
        FROM resume
        LEFT JOIN education ON resume.id = education.resume_id
        LEFT JOIN experience ON resume.id = experience.resume_id
        LEFT JOIN projects ON resume.id = projects.resume_id
        LEFT JOIN skills ON resume.id = skills.resume_id
        WHERE resume.id = '$resume_id'
    ";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error executing query: " . mysqli_error($conn);
    }

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        }
        
        .container {
            max-width: 700px;
            width: 100%;
           
            border-radius: 8px;
            padding: 20px;
        }

        .job-header {
            margin-bottom: 20px;
        }

        .resume {
            font-size: 42px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .job-header strong {
            color: black;
            font-size: 14px;
        }

        .job-header p {
            font-size: 16px;
            color: black;
            margin: 5px 0;
        }

        .resume1 {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        h2 {
            color: #333;
            font-size: 26px;
            margin-top: 20px;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        hr {
            margin: 20px 0;
            border: 1px solid #ccc;
        }

        .job-header h2 + hr {
            background-color: #333;
            height: 3px;
        }

        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
   <div class="container">
        <div class="job-header">
            <div>
                <h1 class="resume"><?php echo htmlspecialchars($job['fullname']); ?></h1>
                <p class="resume1"><?php echo htmlspecialchars($job['mobile_no']); ?> | <?php echo htmlspecialchars($job['address']); ?></p>
                <p class="resume1" style="color: blue;"><?php echo htmlspecialchars($job['email']); ?></p>
                <br>
                <p style="font-size: 26px; font-weight: bold; background-color: #f0f0f0; ">Objective</p><hr>
                <p><?php echo htmlspecialchars($job['objective']); ?></p>
                
                <h2>Education</h2><hr>
                <p><strong><?php echo htmlspecialchars($job['course']); ?></strong> - <?php echo htmlspecialchars($job['institute']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($job['year_of_graduation']); ?></p>

                <?php if (!empty($job['experience_title']) && !empty($job['company']) && !empty($job['experience'])): ?>
                    <h2>Experience</h2><hr>
                    <p><strong>Title:</strong> <?php echo htmlspecialchars($job['experience_title']); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo htmlspecialchars($job['company']); ?></p>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($job['experience']); ?> years</p>
                <?php endif; ?>

                <?php if (!empty($job['project_title']) && !empty($job['projectlink'])): ?>
                    <h2>Projects</h2><hr>
                    <p><strong><?php echo htmlspecialchars($job['project_title']); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($job['start_year']); ?>-<?php echo htmlspecialchars($job['end_year']); ?></p>
                    <p><strong>Key Skills</strong>&nbsp;&nbsp;<?php echo htmlspecialchars($job['skills']); ?></p>
                    <p><a href="<?php echo htmlspecialchars($job['projectlink']); ?>" target="_blank"><?php echo htmlspecialchars($job['projectlink']); ?></a></p>

                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                <?php endif; ?>

                <?php if (!empty($job['skill'])): ?>
                    <h2>Skills</h2><hr>
                    <p><?php echo htmlspecialchars($job['skill']); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <button onclick="window.print();" class="print-button"></button>
   </div>
</body>
</html>

<?php
    } else {
        echo "No resume found for the provided ID.";
    }
}
?> 
