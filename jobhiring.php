<?php
session_start();
include("connect.php");

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
$user_id = $user['id'];

if (isset($_POST["submit"])) {
    // Retrieve and sanitize form data
    $jobname = htmlspecialchars($_POST['jobname']);
    $category = htmlspecialchars($_POST['category']);
    $company = htmlspecialchars($_POST['company']);
    $location = htmlspecialchars($_POST['location']);
    $salary = htmlspecialchars($_POST['salary']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $vacancies = htmlspecialchars($_POST['vacancies']);
    $nature = htmlspecialchars($_POST['nature']);
    $submission = htmlspecialchars($_POST['submission']);

    // Handle file upload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['image_file']['name'];
        $tempfile = $_FILES['image_file']['tmp_name'];
        $folder = "uploads/" . $filename;

        // Create uploads directory if it doesn't exist
        if (!file_exists("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // Move the uploaded file to the uploads folder
        if (move_uploaded_file($tempfile, $folder)) {
            // Insert job details into the database
            // Assuming $user_id is already set from session
        $query = "INSERT INTO jobhiring (user_id, image_file, jobname, category, company, location, salary, description, vacancies, nature, submission)
        VALUES ('$user_id', '$folder', '$jobname', '$category', '$company', '$location', '$salary', '$description', '$vacancies', '$nature', '$submission')";


            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<script type='text/javascript'> alert('Job posted successfully!');</script>";

                // Redirect based on job title
                switch (strtolower($jobname)) {
                    case "frontend developer":
                        header("Location: front.php");
                        break;
                    case "fullstack developer":
                        header("Location: full.php");
                        break;
                    case "backend developer":
                        header("Location: back.php");
                        break;
                    case "software developer":
                        header("Location: software.php");
                        break;
                    case "app developer":
                        header("Location: app.php");
                        break;
                    case "ux/ui developer":
                        header("Location: ux.php");
                        break;
                    case "technical lead":
                        header("Location: tech.php");
                        break;
                    default:
                        echo "<script type='text/javascript'> alert('No specific redirect for this job role.');</script>";
                        break;
                }
                exit();
            } else {
                echo "<script type='text/javascript'> alert('Failed to post the job. Please try again.');</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Failed to upload the file. Please try again.');</script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('No file uploaded or an error occurred during upload.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>joblooking</title>
    <style>
          @import url("hhtps://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        *{
            margin: 0;
padding: 0;
box-shadow: border-box;
font-family: "Poppins",sans-serif;

}
body{
    display: flex ;
    justify-content: center;
    align-items: center;
    background-image: url("image/hiring.jpeg");
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    

}
.xyz
{
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255,255, 0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    color: black;
    border-radius: 10px;
    padding: 30px 40px;
    min-height: 1100px; 
    
}
.xyz h1{
    font-size: 32px;
    text-align: center;
    color: black
    font-style:bold;

}

.xyz .main{
    width: 100%;
    height: 40px;
    margin: 20px 0;
}
.main label{
    font-size: 26px;
}

.main input{
    width: 90%;
    height: 80%;
    border: 1px;
    outline: none;
    border: 2px solid black;
    border-radius: 40px;
    font-size: 18px;
    color: black;
    padding: 2px 15px 4px 15px;
}
.main input::placeholder{
    color: #081b29;
}
.main select{
    width: 95%;
    height: 95%;
    border: 1px;
    outline: none;
    border: 2px solid black;
    border-radius: 40px;
    font-size: 18px;
    color: black;
    padding: 2px 15px 4px 15px;
}
.main select::placeholder{
    color: #081b29;
}
.main textarea{
    width: 90%;
  height:40px;
  border-radius: 40px;
  font-size: 22px;
  padding: 2px 15px 4px 15px;
}
.xyz .BTN{
    width: 40%;
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
  margin-left: 100px;
}

    </style>
</head>
<body>
     <div class="xyz">
        <h1>Post the Jobs</h1>
        <form  method="POST" enctype="multipart/form-data">

        <div class="main">
            <label for="image_file">Company Logo</label><br>
            <input type="file" name="image_file" id="image_file" accept=".jpg,.jpeg,.png,.gif" required>
        </div><br>
        <div class="main">
            <label >Job Title</label><br>
            <input type="text" name="jobname" required>
        </div> <br>   
        <div class="main">
            <label>Category</label><br>
            <input type="text" name="category" required>
        <div class="main">
            <label>Comapany name</label><br>
            <input type="text" name="company" required>
        </div><br>
        <div class="main">
            <label>Location</label><br>
            <input type="text" name="location" required>
        </div><br>
        <div class="main">
            <label>Salary</label><br>
            <input type="number" name="salary" required>
        </div><br>
        <div class="main">
            <label>Job description</label><br>
            <textarea name="description" rows="5" cols="30" ></textarea>
        </div><br>
        <div class="main">
            <label for="">Vacancies</label><br>
            <input type="number" name="vacancies" required>
        </div><br>
        <div class="main">
            <label>Job Nature</label><br>
            <select name="nature">
                <option value="--select nature--">--select nature--</option>
                <option value="full-time">full-time</option>
                <option value="part-time">part-time</option>
            </select>
        </div><br>
        <div class="main">
                <label for="submission_date">Submission Date</label><br>
                <input type="date" name="submission" required>
            </div><br><br>
            <button type="submit" class="BTN" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>