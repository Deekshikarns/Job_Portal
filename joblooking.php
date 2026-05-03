<?php
session_start();
include("Connect.php");

if (isset($_POST['submit'])) {
    // Sanitize and validate the input
    $jobname = mysqli_real_escape_string($conn, trim($_POST['jobname']));
    $jobname = strtolower($jobname);

    // Array of valid job names and corresponding redirect pages
    $jobs = [
        "frontend developer" => "frontlooking.php",
        "fullstack developer" => "fulllooking.php",
        "backend developer" => "backendlooking.php",
        "software developer" => "softwarelooking.php",
        "app developer" => "applooking.php",
        "ux/ui developer" => "uxlooking.php",
        "technical lead" => "techlooking.php"
    ];

    // Check if the job name is valid
    if (array_key_exists($jobname, $jobs)) {
        echo "<script type='text/javascript'> alert('Successful...');</script>";
        header("Location: " . $jobs[$jobname]);
        exit();
    } else {
        echo "<script type='text/javascript'> alert('Invalid job name. Please try again.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         #header{
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
#header .wrap2{
  font-size: 40px;
  margin-left: 0;
}
#navbar{
    display: flex;
    align-items: center;
    justify-content: center;
}

#navbar li{
    list-style: none;
    padding: 0 30px;
    position: relative;
}

#navbar li a{
    text-decoration: none;
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    transition: 0.3s ease;
}


#navbar li a.btn {
    background: #088178;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s ease;
    margin-left: 650px;
}

#navbar li a.btn:hover {
    background: #066358; 
}
#navbar li a.btn1 {
    background: white;
    color: red;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    transition: 0.3s ease;
    border: 1px solid red;
}
#navbar li a.btn1:hover {
    background: #066358; 
}

#navbar li a img{
              width: 35px;
              margin-top: -27px;
              height: 35px;
}

#hero{
    background-image: url("image/image.jpg");
    height: 90vh;
    width: 100%;
    background-size: cover;
    background-position: top 25% right 0;
    padding: 0 80px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
}
#hero .register {
  display: flex; 
  align-items: center; 
  gap: 1px; 
}
#hero .register-container {
  border: 2px solid #d3d3d3;
  border-radius: 20px; 
  padding: 20px; 
  background-color: #f9f9f9; 
  display: flex; 
  flex-direction: column;
  align-items: center; 
  width: 50%;
}
#hero  .register .pro4{
  width: 80%;
  height:35px;
  border-radius: 40px;
  font-size: 22px;
  padding: 2px 15px 4px 15px;
 }
#hero .register .pro4::placeholder{
                        color: black;
                        font-size: 16px;
                     }

   
#hero .register  button {
  background-color: #E55451;
  color: #ffffff;
  border: 0;
  padding: 2px 15px 4px 15px;
  border-radius: 20px; /* Optional for rounded corners */
  cursor: pointer;
  font-weight: 700;
  font-size: 15px;
  height: 40px; /* Match the height of other elements */
}



    </style>
</head>
<body>
<section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="joblooking.php">Home</a></li>
                <li><a href="resume.php">Resume Bulider</a></li>
                <li><a href="assignment.php">Assignment</a></li>
                <li><a href="look_profile.php"><img src="image/pro.png"></a></li>
            </ul>
        </div>
      
    </section>
    <section id="hero">
    <div class="register-container">
    
    <form class="" action="" method="POST">
    <div class="register">
            <input type="text" class="pro4" name="jobname"  placeholder="Job category or keyword"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn" name="submit">Search</button></form>
        </div>
</div>
    </section>


</body>
</html>