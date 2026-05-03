<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resume</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
           
            justify-content: center;
            align-items: center;
            background: #FFEE8C;
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
        .resume {
            width: 1100px;
            background: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: black;
            border-radius: 10px;
            padding: 30px 40px;
            min-height: 2100px;
            margin-left: 200px;
        }
        .resume h2 {
            font-size: 30px;
        }
        .main {
            width: 100%;
            height: 40px;
            margin: 20px 0;
        }
        .main label {
            font-size: 18px;
        }
        .main input,
        .main select {
            width: 35%;
            height: 80%;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            font-size: 18px;
            color: black;
            padding: 2px 15px;
            outline: none;
        }
        .main1 input{
            width: 82%;
            height: 70px;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            font-size: 18px;
            color: black;
            padding: 2px 15px;
            outline: none;
        }
        .main textarea{
            width: 82%;
            height: 70px;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            font-size: 18px;
            color: black;
            padding: 2px 15px;
            outline: none;
        }
        #traveller-form .form {
        margin-bottom: 60px; 
       
}
    #project-form{
        min-height:200px;
    }
    .form{
           width: 100%;
            height: 40px;
            margin: 20px 0;
    }
   .additional-education a{
        text-decoration: none; 
        margin-left: 900px;
       position:relative;
       top: -50px;
    }
       
    .additional-experience a {
        text-decoration: none;
        margin-left: 900px;
       
    }

    .additional-project a{
        text-decoration: none; 
        margin-left: 900px;
       position:relative;
       top: -50px;
    }

    .delete-btn {
    text-align: right;
    color: red;
    cursor: pointer;
    font-size: 14px;
    margin-bottom: 5px;
}
    .resume .BTN{
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
<section id="header">
        <a href="#"><img src="image/home.png" class="logo" alt="Logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="joblooking.php">Back to Home</a></li>
                
            </ul>
        </div>
    </section><br><br>
    <section>
    <div class="resume">
        <h2>Create Resume</h2>
        <hr><br>
        <form action="index.php" method="POST">
            <h3><i class='bx bxs-contact' ></i>  Personal Information</h3>
            <div class="main">
                <label for="fullname">Full Name</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="email">E-Mail</label><br><br>
                <input type="text" placeholder="Full Name" name="fullname" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          
                <input type="email" placeholder="E-Mail" name="email" required><br><br>
            
                <div class="main1">
                    <label for="objective">Objective</label><br>
                    <input type="text" name="objective" >
              </div><br>

                <label for="mobile_no">Mobile No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="dob">Date of Birth</label><br><br>
                <input type="text" placeholder="Mobile No" name="mobile_no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="date" name="dob"><br><br>
            
                <label for="gender">Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="religion">Religion</label><br><br>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                <input type="text" placeholder="Religion" name="religion"><br><br>
            
                <label for="nationality">Nationality</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="marital_status">Marital Status</label><br><br>
                <input type="text" placeholder="Nationality" name="nationality">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          
                
                <select name="marital_status">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Other">Other</option>
                </select><br><br>
            
                <label for="hobbies">Hobbies</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="languages">Languages</label><br><br>
                <input type="text" name="hobbies" placeholder="Hobbies">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           
                <input type="text" name="languages" placeholder="Languages"><br><br>
           
                <label for="address">Address</label><br><br>
                <textarea name="address" ></textarea><br><br>
                <hr><br>

                <h3>Skills</h3>
                <input type="text" name="skill" placeholder="enter the skills"><br><br><hr><br><br>


                <h3><i class='bx bx-book-bookmark' ></i>  Education Information</h3>
                <div id="traveller-form">
                    <div class="form">
                        <input type="text" name="course[]" placeholder="Course">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="institute[]" placeholder="Institute"><br><br>
                        <input type="date" name="year[]" placeholder="Year of Graduation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" name="marks[]" placeholder="Marks / CGPA"><br><br>
                    </div>
                </div><br><br>
                <div class="additional-education">
                    <a href="#" id="add-education"><i class='bx bx-add-to-queue'></i>Add New</a><br><br>
                </div>
                <hr><br>

                <h3><i class='bx bx-briefcase'></i>  Experience Information</h3>
                <div id="experience-form"></div>
                <div class="form"></div>
                <div class="additional-experience">
                    <a href="#" id="add-experience">+Add New</a>
                </div>
                <hr><br>

                <h3>Project Details</h3>
                    <div id="project-form">
                        <div class="form">
                            <input type="text" name="title[]" placeholder="Project title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="projectlink[]" placeholder="Project Link"><br><br>
                            <input type="date" name="start_date[]" placeholder="From">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="date" name="end_date[]" placeholder="To"><br><br>
                            <input type="number" name="team_size[]" placeholder="Team size">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="skills[]" placeholder="Key skills"><br><br>
                            <textarea name="description[]" placeholder="Description"></textarea><br><br>
                        </div>
                    </div><br><br>

                    <div class="additional-project">
                        <a href="#" id="add-project"><i class='bx bx-add-to-queue'></i>Add New</a><br><br>
                    </div>

                    <hr><br> 

                   

<br><br>
                <button type="submit" class="BTN" name="submit">Submit</button>
</form>
</div>

</section>
<script>
  document.getElementById('add-education').addEventListener('click', function(event) {
    event.preventDefault();

    const formContainer = document.getElementById('traveller-form');

    const newForm = document.createElement('div');
    newForm.className = 'form';

    newForm.innerHTML = `
        <p class="delete-btn"><i class='bx bxs-trash'></i> Delete</p>
        <input type="text" name="course[]" placeholder="Course">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="institute[]" placeholder="Institute"><br><br>
        <input type="date" name="year[]" placeholder="Year of Graduation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="number" name="marks[]" placeholder="Marks / CGPA"><br><br>
    `;

    formContainer.appendChild(newForm);
  });

  document.getElementById('add-experience').addEventListener('click', function (event) {
    event.preventDefault();

    const experienceContainer = document.getElementById('experience-form');

    const newExperience = document.createElement('div');
    newExperience.className = 'form';

    newExperience.innerHTML = `
        <p class="delete-btn"><i class='bx bxs-trash'></i> Delete</p>
        <input type="text" name="job_title[]" placeholder="Job Title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="company[]" placeholder="Company"><br><br>
        <input type="number" name="experience[]" placeholder="Experience">
    `;

    experienceContainer.appendChild(newExperience);
  });

  document.getElementById('add-project').addEventListener('click', function (event) {
    event.preventDefault();

    const projectContainer = document.getElementById('project-form');

    const newProject = document.createElement('div');
    newProject.className = 'form';

    newProject.innerHTML = `
        <p class="delete-btn"><i class='bx bxs-trash'></i> Delete</p>
        <input type="text" name="title[]" placeholder="Project title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="projectlink[]" placeholder="Project Link"><br><br>
        <input type="date" name="start_date[]" placeholder="From">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="date" name="end_date[]" placeholder="To"><br><br>
        <input type="number" name="team_size[]" placeholder="Team size">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="skills[]" placeholder="Key skills"><br><br>
        <textarea name="description[]" placeholder="Description"></textarea><br><br>

    `;

    projectContainer.appendChild(newProject);
});


  document.addEventListener('click', function(event) {
    if (event.target.closest('.delete-btn')) {
        event.target.closest('.form').remove();
    }
  });
</script>

   
</body>
</html>
