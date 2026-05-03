<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize user inputs
    $job_id = htmlspecialchars($_POST['job_id']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $linkedin = filter_var($_POST['linkedin'], FILTER_VALIDATE_URL);
    $github = filter_var($_POST['github'], FILTER_VALIDATE_URL);
    
    // Get the file information
    $filename = $_FILES['resume']['name'];
    $tempfile = $_FILES['resume']['tmp_name'];
    $folder = "uploads/" . $filename;  // Define the target path for the uploaded file

    // Check if the "uploads" directory exists, if not, create it
    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);  // Create uploads directory if it doesn't exist
    }

    // Move the uploaded file to the "uploads" directory
    if (move_uploaded_file($tempfile, $folder)) {
        // Prepare the SQL statement
        $stmt = "INSERT INTO applications (job_id, resume, first_name, last_name, contact_number, email, location, linkedin, github) 
                 VALUES ('$job_id', '$folder', '$first_name', '$last_name', '$contact_number', '$email', '$location', '$linkedin', '$github')";

        // Execute the SQL query
        $result = mysqli_query($conn, $stmt);

        // Check the result and send an email
        if ($result) {
            $application_id = mysqli_insert_id($conn);

            // Prepare the email content
            $subject = 'New Job Application Received';
            $message = "A new job application has been submitted for job ID: $job_id.<br>
                        <b>Name:</b> $first_name $last_name<br>
                        <b>Email:</b> $email<br>
                        <b>Phone:</b> $contact_number<br>
                        <b>Location:</b> $location<br>
                        <b>LinkedIn:</b> $linkedin<br>
                        <b>GitHub:</b> $github<br>
                        <b>Resume:</b> <a href='$folder' target='_blank'>$filename</a>";

            // Set the email headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: no-reply@yourdomain.com" . "\r\n";  // Change this to a valid email
            $headers .= "Reply-To: $email" . "\r\n";  // Reply to the applicant's email

            // Send the email
            $to = 'your-email@gmail.com';  // Change this to your Gmail address
            if (mail($to, $subject, $message, $headers)) {
                echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center;'>
                        <div>
                            <div style='font-size: 50px; font-weight: bold; color: #28a745;'>Thank you for applying. Your application has been forwarded to the company.</div>
                            <div style='height: 20px;'></div>  <!-- Adds space between the messages -->
                            <div>
                                <a href='view.php?id=$application_id' style='font-size: 20px; font-weight: bold; color: #007bff; text-decoration: none;'>View Application</a>
                            </div>
                        </div>
                      </div>";
            } else {
                echo "Error: Unable to send email.";
            }
        } else {
            echo "Error inserting application data into the database.";
        }
    } else {
        echo "Error uploading the resume.";
    }
}
?>
