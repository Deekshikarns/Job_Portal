<?php
// Assuming you're connected to the database
include("connect.php");

if (isset($_POST['submit'])) {
    // Personal Information
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $objective = mysqli_real_escape_string($conn, $_POST['objective']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);
    $languages = mysqli_real_escape_string($conn, $_POST['languages']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Insert personal info into resume table
    $query = "INSERT INTO resume (fullname, email, objective, mobile_no, dob, gender, religion, nationality, marital_status, hobbies, languages, address) 
              VALUES ('$fullname', '$email', '$objective', '$mobile_no', '$dob', '$gender', '$religion', '$nationality', '$marital_status', '$hobbies', '$languages', '$address')";

    if (mysqli_query($conn, $query)) {
        $resume_id = mysqli_insert_id($conn); // Get the last inserted resume id

        // Insert Education Information
        if (!empty($_POST['course']) && is_array($_POST['course'])) {
            $courses = $_POST['course'];
            $institutes = $_POST['institute'];
            $years = $_POST['year'];
            $marks = $_POST['marks'];

            for ($i = 0; $i < count($courses); $i++) {
                $course = mysqli_real_escape_string($conn, $courses[$i]);
                $institute = mysqli_real_escape_string($conn, $institutes[$i]);
                $year = mysqli_real_escape_string($conn, $years[$i]);
                $mark = mysqli_real_escape_string($conn, $marks[$i]);

                $query_education = "INSERT INTO education (resume_id, course, institute, year_of_graduation, marks)
                                    VALUES ('$resume_id', '$course', '$institute', '$year', '$mark')";
                mysqli_query($conn, $query_education);
            }
        }

        // Insert Project Information
        if (!empty($_POST['title']) && is_array($_POST['title'])) {
            $titles = $_POST['title'];
            $projectlinks = $_POST['projectlink'];
            $start_dates = $_POST['start_date'];
            $end_dates = $_POST['end_date'];
            $team_sizes = $_POST['team_size'];
            $skills = $_POST['skills'];
            $descriptions = $_POST['description'];

            for ($i = 0; $i < count($titles); $i++) {
                $title = mysqli_real_escape_string($conn, $titles[$i]);
                $projectlink = mysqli_real_escape_string($conn, $projectlinks[$i]);
                $start_date = mysqli_real_escape_string($conn, $start_dates[$i]);
                $end_date = mysqli_real_escape_string($conn, $end_dates[$i]);
                $team_size = mysqli_real_escape_string($conn, $team_sizes[$i]);
                $skill = mysqli_real_escape_string($conn, $skills[$i]);
                $description = mysqli_real_escape_string($conn, $descriptions[$i]);

                $query_project = "INSERT INTO projects (resume_id, title, projectlink, start_date, end_date, team_size, skills, description)
                                  VALUES ('$resume_id', '$title', '$projectlink', '$start_date', '$end_date', '$team_size', '$skill', '$description')";
                mysqli_query($conn, $query_project);
            }
        }

        // Insert Experience Information
        if (!empty($_POST['experience_title']) && is_array($_POST['experience_title'])) {
            $experience_titles = $_POST['experience_title'];
            $companies = $_POST['company'];
            $experiences = $_POST['experience'];

            for ($i = 0; $i < count($experience_titles); $i++) {
                $experience_title = mysqli_real_escape_string($conn, $experience_titles[$i]);
                $company = mysqli_real_escape_string($conn, $companies[$i]);
                $experience_years = mysqli_real_escape_string($conn, $experiences[$i]);

                $query_experience = "INSERT INTO experience (resume_id, title, company, experience)
                                     VALUES ('$resume_id', '$experience_title', '$company', '$experience_years')";
                mysqli_query($conn, $query_experience);
            }
        }
        if (isset($_POST['skills']) && !empty($_POST['skills'])) {
            $skills = $_POST['skills']; // Assuming skills is an array
            foreach ($skills as $skill) {
                $skill = mysqli_real_escape_string($conn, $skill);
                $query_skills = "INSERT INTO skills (resume_id, skill) VALUES ('$resume_id', '$skill')";
                mysqli_query($conn, $query_skills);
            }
        }

        echo '<a href="view_resume.php?resume_id=' . $resume_id . '" class="btn btn-primary">View Resume</a>';
        echo "Resume created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
