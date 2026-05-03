<?php
session_start();
include("Connect.php");
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
  width: 60%;
  height:40px;
  border-radius: 40px;
  font-size: 22px;
  padding: 2px 15px 4px 15px;
 }
#hero .register .pro4::placeholder{
                        color: black;
                        font-size: 16px;
                     }
#hero .register .pro3
{
  font-size: 16px; /* Adjust the font size as needed */
  width: 60%; /* Adjust the width as needed */
  height: 40px;
  border: 2px solid black;
  border-radius: 40px;
  padding: 2px 15px 4px 15px;

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
                <li><a class="active" href="home.php">Home</a></li>
                
                <li><a class="btn" href="register.php">Register</a></li>
                <li><a class="btn1" href="login.php">Login</a></li>
            </ul>
        </div>
      
    </section>
    <section id="hero">
    <div class="register-container">
    
    <form class="" action="" method="POST">
    <div class="register">
            <input  type="text" class="pro4"  name="jobholder" placeholder="Job category or keyword"></textarea>
            <select class="pro3" name="select experience">
            <option>  Fresher (less than 1 year)</option>
            <option> 1 YEAR</option>
            <option> 2 years</option>
            <option> 3 years</option>
            <option> 4 years</option>
            <option> 5 years</option>
            
        </select>
        <button type="submit" class="btn" name="submit">Search</button></form>
        </div>
</div>
    </section>


</body>
</html>