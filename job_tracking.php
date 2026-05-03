<?php
include('connect.php'); // Include the database connection file

if (isset($_GET['id'])) {
    $application_id = intval($_GET['id']);
    
    // Get application details
    $query = $conn->prepare("SELECT applications.job_id, applications.first_name, applications.last_name, applications.status, jobhiring.jobname FROM applications JOIN jobhiring ON applications.job_id = jobhiring.id WHERE applications.id = ?");
    $query->bind_param("i", $application_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $application = $result->fetch_assoc();
        $status = $application['status'];
        $jobname = $application['jobname'];
        echo "<h2 style='margin-top:190px; margin-left: 500px; font-size: 48px;'>Application Status</h2>";
        echo "<p style='margin-left: 500px; font-size: 28px;'>Your application status for the job: <strong>{$jobname}</strong></p>";
        echo "<p style='margin-left: 500px; font-size: 28px;'><strong>Status:</strong> {$status}</p>";
    } else {
        echo "<p>No application found for the given ID.</p>";
    }

    $query->close();
} else {
    echo "<p>Invalid application ID.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRACKING</title>
    <style>
        body{
            background: url('image/ba.jpg');
            background-size: cover;
        }
    </style>
</head>
<body>
    
</body>
</html>
