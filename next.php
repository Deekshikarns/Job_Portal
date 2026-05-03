<?php
include('connect.php');

// Validate Course Selection
if (!isset($_POST['course_id'])) {
    echo "<p style='color: red;'>No course selected!</p>";
    exit();
}

$course_id = $_POST['course_id'];

// Fetch Course Name and Duration
$course_query = $conn->query("SELECT course_name, duration FROM courses WHERE id = $course_id");
$course = $course_query->fetch_assoc();
$quiz_duration = $course['duration']; // Fetch duration in minutes

// Fetch Questions for the selected course
$questions = $conn->query("SELECT id, question, option1, option2, option3, option4, correct_option FROM questions WHERE course_id = $course_id ORDER BY RAND()");

$quiz_data = [];
while ($row = $questions->fetch_assoc()) {
    $quiz_data[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?= htmlspecialchars($course['course_name']) ?></title>
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
                background: url("image/ba1.jpg");
                background-size: cover;
            }
        .quiz-container {
            width: 70%;
            margin: auto;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-top:90px;
            font-size:18px;
        }
        .submit-btn, .nav-btn {
            padding: 10px 20px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .submit-btn { background-color: #28a745; }
        .submit-btn:hover { background-color: #218838; }
        .nav-btn { background-color: #007bff; }
        .nav-btn:hover { background-color: #0056b3; }
        .hidden { display: none; }
        .timer {
            font-size: 20px;
            font-weight: bold;
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="quiz-container">
        <h2>Quiz - <?= htmlspecialchars($course['course_name']) ?></h2>
        <div class="timer" id="timer">Time Left: <?= $quiz_duration ?>:00</div>
        
        <form id="quizForm" method="post" action="submit_quiz.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>">
            <div id="question-container">
                <?php foreach ($quiz_data as $index => $question) { ?>
                    <div class="question <?= $index == 0 ? '' : 'hidden' ?>" data-index="<?= $index ?>"><br>
                        <p><strong><?= ($index + 1) . '. ' . nl2br(htmlspecialchars($question['question'])) ?></strong></p><br><br>
                        <input type="radio" name="q<?= $question['id'] ?>" value="1"> <?= htmlspecialchars($question['option1']) ?><br><br>
                        <input type="radio" name="q<?= $question['id'] ?>" value="2"> <?= htmlspecialchars($question['option2']) ?><br><br>
                        <input type="radio" name="q<?= $question['id'] ?>" value="3"> <?= htmlspecialchars($question['option3']) ?><br><br>
                        <input type="radio" name="q<?= $question['id'] ?>" value="4"> <?= htmlspecialchars($question['option4']) ?><br><br>
                        <input type="hidden" name="correct<?= $question['id'] ?>" value="<?= $question['correct_option'] ?>">
                    </div>
                <?php } ?>
            </div>

            <button type="button" class="nav-btn hidden" id="prevBtn">Previous</button>
            <button type="button" class="nav-btn" id="nextBtn">Next</button>
            <button type="submit" class="submit-btn hidden" id="submitBtn" name="submit_quiz">Submit Quiz</button>
        </form>
    </div>

    <script>
        let currentQuestion = 0;
        const questions = document.querySelectorAll(".question");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");
        const submitBtn = document.getElementById("submitBtn");

        function updateNavigation() {
            prevBtn.classList.toggle("hidden", currentQuestion === 0);
            nextBtn.classList.toggle("hidden", currentQuestion === questions.length - 1);
            submitBtn.classList.toggle("hidden", currentQuestion !== questions.length - 1);
        }

        function showQuestion(index) {
            questions.forEach((q, i) => q.classList.toggle("hidden", i !== index));
        }

        nextBtn.addEventListener("click", () => {
            if (currentQuestion < questions.length - 1) {
                currentQuestion++;
                showQuestion(currentQuestion);
                updateNavigation();
            }
        });

        prevBtn.addEventListener("click", () => {
            if (currentQuestion > 0) {
                currentQuestion--;
                showQuestion(currentQuestion);
                updateNavigation();
            }
        });

        showQuestion(currentQuestion);
        updateNavigation();

        // Timer Logic (Dynamic Duration)
        let timeLeft = <?= $quiz_duration ?> * 60; // Fetch duration dynamically
        const timerElement = document.getElementById("timer");

        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            
            if (timeLeft <= 0) {
                document.getElementById("quizForm").submit();
            }
            timeLeft--;
        }
        
        setInterval(updateTimer, 1000);
    </script>

</body>
</html>
