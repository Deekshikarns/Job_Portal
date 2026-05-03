<?php
include('connect.php');
session_start();
require_once('vendor/autoload.php');  // TCPDF autoloader

if (isset($_GET['resume_id'])) {
    $resume_id = $_GET['resume_id'];

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
            DATE_FORMAT(projects.start_date, '%d %M %Y') AS start_date, 
            DATE_FORMAT(projects.end_date, '%d %M %Y') AS end_date,
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
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);

       $pdf = new TCPDF();

        // Disable the default header
        $pdf->setPrintHeader(false);

        // Optional: Disable the default footer if not needed
        $pdf->setPrintFooter(false);

        // Set top margin to 10 (or less)
        $pdf->SetMargins(10, 10, 10);  // left, top, right

        // Add a page
        $pdf->AddPage();

        // Name
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 10, htmlspecialchars($job['fullname']), 0, 1, 'C');


        // Contact Info
       // Switch to a Unicode-supporting font
        $pdf->SetFont('dejavusans', '', 12);

        // Contact Info with diamond symbol
        $diamond = html_entity_decode('&#9830;', ENT_QUOTES, 'UTF-8');
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Cell(0, 10, htmlspecialchars($job['mobile_no']) . '     ' . $diamond . '  ' . htmlspecialchars($job['email']), 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(5);


        // Objective
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Objective', 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(2);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 10, htmlspecialchars($job['objective']));
        $pdf->Ln(5);

        // Education
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Education', 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(2);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, htmlspecialchars($job['course']) . ' - ' . htmlspecialchars($job['institute']) . ' (' . htmlspecialchars($job['year_of_graduation']) . ')', 0, 1);
        $pdf->Ln(5);

        // Experience
        if (!empty($job['experience_title'])) {
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Experience', 0, 1);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, 'Title: ' . htmlspecialchars($job['experience_title']), 0, 1);
            $pdf->Cell(0, 10, 'Company: ' . htmlspecialchars($job['company']), 0, 1);
            $pdf->Cell(0, 10, 'Experience: ' . htmlspecialchars($job['experience']) . ' years', 0, 1);
            $pdf->Ln(5);
        }

        // Projects
        if (!empty($job['project_title'])) {
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Projects', 0, 1);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(100, 5, htmlspecialchars($job['project_title']), 0, 0);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 5, '(' . htmlspecialchars($job['start_date']) . ' - ' . htmlspecialchars($job['end_date']) . ')', 0, 1);
            $pdf->Ln(1);

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(25, 10, 'Skills:', 0, 0);
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, htmlspecialchars($job['skills']), 0, 1);

            $pdf->SetTextColor(0, 0, 255);
            $pdf->Write(0, htmlspecialchars($job['projectlink']), htmlspecialchars($job['projectlink']), '', false, 0, false, false, false);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Ln(10);

            $pdf->MultiCell(0, 10, htmlspecialchars($job['description']));
            $pdf->Ln(5);
        }

        // Skills Section
        if (!empty($job['skill'])) {
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Skills', 0, 1);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', '', 12);
            $skillsArray = explode(',', $job['skill']);
            foreach ($skillsArray as $skill) {
                $pdf->Cell(5);
                $pdf->Cell(0, 7, '• ' . htmlspecialchars(trim($skill)), 0, 1);
            }
            $pdf->Ln(5);
        }

        // Personal Info
        if (!empty($job['gender']) || !empty($job['dob']) || !empty($job['languages']) || !empty($job['address'])) {
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Personal Information', 0, 1);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', '', 12);

            if (!empty($job['gender'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(40, 10, 'Gender: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, htmlspecialchars($job['gender']), 0, 1);
            }

            if (!empty($job['dob'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(40, 10, 'Date of Birth: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, htmlspecialchars($job['dob']), 0, 1);
            }

            if (!empty($job['languages'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(40, 10, 'Languages: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, htmlspecialchars($job['languages']), 0, 1);
            }

            if (!empty($job['address'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->MultiCell(0, 10, 'Address: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->MultiCell(0, 10, htmlspecialchars($job['address']), 0, 'L');
            }

            if (!empty($job['email'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(40, 10, 'Email: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, htmlspecialchars($job['email']), 0, 1);
            }

            if (!empty($job['mobile_no'])) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(40, 10, 'Phone: ', 0, 0);
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Cell(0, 10, htmlspecialchars($job['mobile_no']), 0, 1);
            }

            $pdf->Ln(10);
        }

        $pdf->Output('resume_details.pdf', 'I');
    } else {
        echo "No resume found for the provided ID.";
    }
}
?>
