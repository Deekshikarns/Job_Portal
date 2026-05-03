<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = htmlspecialchars($_POST['job_id']);
} else {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
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
            background: #f4f4f4;
        }
        .xyz {
            width: 600px;
            background: transparent;
            border: none;
            backdrop-filter: blur(28px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: black;
            border-radius: 10px;
            padding: 30px 40px;
            margin-left:100px;
        }
        .xyz h1{
            font-size:22px;

        }
        .main {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            width: 550px;
        }
        .main label {
            width: 180px; 
            font-size: 16px;
            font-weight: 600;
            margin-right: 10px;
        }
        .main input {
            flex: 1; 
            width: 500px;
            height: 35px;
            border: 2px solid black;
            border-radius: 5px;
            font-size: 14px;
            padding: 5px 10px;
            margin-left: 80px;
        }
        .main input::placeholder {
            color: #081b29;
        }
        .main1 {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            width: 450px;
        }
        .main1 label {
            width: 180px; 
            font-size: 16px;
            font-weight: 600;
            margin-right: 10px;
        }
        .main1 input {
            flex: 1; 
            width: 300px;
            height: 35px;
            border: 2px solid black;
            border-radius: 5px;
            font-size: 14px;
            padding: 5px 10px;
            margin-left: 130px;
        }
        .main1 input::placeholder {
            color: #081b29;
        }
        .BTN {
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
        
        .declaration{
            margin-top: 20px;
        }
        .declaration label{         
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="xyz">
        <h1>Submit your Application</h1><br><br>
        <form action="submit_application.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
            <div class="main1">
                <label for="resume">Resume/CV*</label>
                <input type="file" id="resume" name="resume" accept=".doc,.docx,.pdf" required>
            </div><br>
            <div class="main">
                <label for="first_name">First Name*</label>
                <input type="text" id="first_name" name="first_name" required>
            </div><br>
            <div class="main">
                <label for="last_name">Last Name*</label>
                <input type="text" id="last_name" name="last_name" required>
            </div><br>
            <div class="main">
                <label for="contact_number">phone*</label>
                <input type="tel" id="contact_number" name="contact_number" required>
            </div><br>
            <div class="main">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div><br>
            <div class="main">
                <label for="location">Current Location*</label>
                <input type="text" id="location" name="location" required>
            </div><br><br><br>
            <h1>Links</h1><br>
            <div class="main">
                <label for="linkedin">LinkedIn Profile:</label>
                <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/your-profile">
            </div><br>
            <div class="main">
                <label for="github">GitHub Profile:</label>
                <input type="url" id="github" name="github" placeholder="https://github.com/your-profile">
            </div><br>
            <h1>Declaration</h1><br>
            <div class="declaration">
            <div class="checkbox">
                <input type="checkbox" id="confirmation" name="confirmation" required>
                <label for="confirmation">
                I hereby confirm that all information provided to company, including but not limited to the information represented in this application form, my LinkedIn profile, my resume/CV, and any other documents submitted in connection with my application, is true, complete, and accurate to the best of my knowledge. I understand that any false or misleading information may result in the rejection of my application or termination of employment if discovered at a later stage.
                </label>
            </div>
    </div><br>
            <button type="submit" class="BTN" name="submit">Submit Application</button>
        </form>
    </div>
</body>
</html>
