<?php
session_start(); // Start session at the top of the page

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 
include('connect.php'); 

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM signup WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    exit;
}

$user = mysqli_fetch_assoc($result);
$user_id = $user['id']; // The user_id is fetched from the session's email

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
    
    // Handle file upload
    $filename = $_FILES['resume']['name'];
    $tempfile = $_FILES['resume']['tmp_name'];
    $folder = "uploads/" . basename($filename);

    // Ensure "uploads" directory exists
    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($tempfile, $folder)) {
        $job_query = $conn->prepare("SELECT jobname, company, category, image_file FROM jobhiring WHERE id = ?");
        $job_query->bind_param("i", $job_id);
        $job_query->execute();
        $job_result = $job_query->get_result();

        if ($job_result->num_rows > 0) {
            $job_data = $job_result->fetch_assoc();
            $jobname = $job_data['jobname'];
            $company_name = $job_data['company'];
            $role = $job_data['category'];
            $image_file = $job_data['image_file']; // Path to the company's image

            $job_query->close();
            $stmt = $conn->prepare(
                "INSERT INTO applications (job_id, userid, resume, first_name, last_name, contact_number, email, location, linkedin, github, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $status = 'Under Review'; // Default status
            $stmt->bind_param(
                "issssssssss", 
                $job_id, $user_id, $folder, $first_name, $last_name, 
                $contact_number, $email, $location, $linkedin, $github, $status
            );

        if ($stmt->execute()) {
            $application_id = $stmt->insert_id;

            // Send thank-you email to the user
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'bbdeekshika@gmail.com'; 
                $mail->Password = 'qkwl qvel cpfr mykz'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('no-reply@example.com', "'Recruitment Team'"); 
                $mail->addAddress($email, "$first_name $last_name"); 
                // Embed company logo
                if (file_exists($image_file)) {
                    $mail->addEmbeddedImage($image_file, 'company_logo');
                }

                // Email content
                $mail->isHTML(true);
                $mail->Subject = "Thank You for Applying!";
                $mail->Body = "
               <div style='text-align: center; margin: 20px 0;'>
                    <h1>
                        <img src='cid:company_logo' alt='Company Logo' style='height:50px; display: block; margin: 0 auto;'>
                        $company_name
                    </h1>   
                </div>


                <h4>Thank you for your application</h4>
                <hr>
                <p>Hi $first_name $last_name,</p>
               <p>Thank you for applying for the role of $jobname at $company_name.</p>
                <p>We have successfully received your application.</p>
                <p>Our hiring team is reviewing your qualifications, and we will reach out to you regarding the next steps shortly.</p>
                <p>If shortlisted, you will be contacted within the next business days to schedule the next steps in our selection process.</p>
                <p>If you'd like to review your submitted application, please click the link <a href='http://localhost/job_portal/job_tracking.php?id=$application_id' >Track Your Application</a></p>
                <p>We thank you for your interest in this role and wish you success with your application.</p>



                <p>Best Regards,</p>

                <p>$company_name</p>
                ";

                $mail->send();
                echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center;'>
                        <div>
                            <div style='font-size: 4  0px; font-weight: bold; color: #28a745;'>Thank you for applying. </div>

                            <div style='font-size: 30px; font-weight: bold; color: #28a745;'>Your application has been forwarded to the company.</div>
                            <div style='height: 20px;'></div>
                            <div style='font-size: 20px; font-weight: bold; color: #007bff;'>You can check your email for further updates.</div>
                        </div>
                      </div>";
                
            } catch (Exception $e) {
                echo "Your application was submitted successfully, but the email could not be sent. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: Unable to save application. " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Job details not found.";
    }
} else {
    echo "Error uploading the resume.";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit</title>
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
</body>
</html>
