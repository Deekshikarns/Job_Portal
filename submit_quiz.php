<?php
include('connect.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

// Get the user's information
$stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows == 0) {
    echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    exit;
}

$user = $result->fetch_assoc();
$user_id = $user['id'];  // Get the user ID

// Get the course ID from the form
$course_id = $_POST['course_id']; // Ensure course_id is passed

// Initialize variables for quiz results
$score = 0;
$total_questions = 0;
$answers = [];

// Loop through each question and check answers
foreach ($_POST as $key => $value) {
    if (strpos($key, 'q') === 0) { // Check if the key starts with 'q'
        $question_id = str_replace('q', '', $key);
        $correct_answer = $_POST['correct' . $question_id];

        // Fetch question text
        $stmt = $conn->prepare("SELECT question FROM questions WHERE id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $question = $result->fetch_assoc();

        // Store question and correct answer for display
        $answers[] = [
            'question' => $question['question'],
            'user_answer' => $value,
            'correct_answer' => $correct_answer
        ];

        // If the answer is correct, increment the score
        if ($value == $correct_answer) {
            $score++;
        }

        $total_questions++;
    }
}

// Calculate percentage
$percentage = ($score / $total_questions) * 100;

// Insert quiz results into the database
$stmt = $conn->prepare("INSERT INTO quiz_history (user_id, course_id, score, total_questions, percentage, taken_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("iiiii", $user_id, $course_id, $score, $total_questions, $percentage);
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .result-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .score {
            font-size: 24px;
            font-weight: bold;
            color: green;
        }
        .percentage {
            font-size: 20px;
            color: blue;
        }
        .question {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }
        .correct-answer {
            font-size: 16px;
            color: red;
        }
        .retake-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .retake-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="result-container">
        <h2>Quiz Results</h2>
        <p class="score">Your Score: <?= $score ?> / <?= $total_questions ?></p>
        <p class="percentage">Percentage: <?= round($percentage, 2) ?>%</p>

        <h3>Review Your Answers</h3>
        <?php foreach ($answers as $answer) { ?>
            <div>
                <p class="question"><?= htmlspecialchars($answer['question']) ?></p>
                <p class="correct-answer">Correct Answer: <?= htmlspecialchars($answer['correct_answer']) ?></p>
            </div>
        <?php } ?>

        <a href="assignment.php" class="retake-btn">Back to Home</a>
    </div>

</body>
</html>
