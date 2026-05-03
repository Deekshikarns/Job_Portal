<?php
session_start();
$conn = new mysqli("localhost", "root", "", "jobhiring");

if (!isset($_SESSION['user_id'])) $_SESSION['user_id'] = 1;
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role']) && !isset($_SESSION['questions'])) {
    $_SESSION['interview_role'] = $_POST['role'];
    $_SESSION['question_index'] = 0;

    $role = $_SESSION['interview_role'];

    $common_questions = [
        "Tell me about yourself.",
        "What are your strengths?",
        "What are your weaknesses?",
        "What are your hobbies?",
        "Where do you see yourself in five years?",
        "Why should we hire you?"
    ];

    $role_questions = [
        'Web Developer' => [
            "What is the difference between HTML and HTML5?",
            "Explain how you optimize website performance.",
            "What is a REST API?",
            "Explain the concept of responsive design.",
            "What JavaScript frameworks do you know?",
            "What is version control and why is it important?",
            "How do you handle debugging in code?",
            "Explain the difference between front-end and back-end development."
        ],
        'HR Manager' => [
            "How do you handle employee conflict?",
            "What’s your recruitment strategy?",
            "How do you conduct interviews?",
            "How do you manage performance reviews?",
            "Explain your approach to employee engagement.",
            "How do you ensure compliance with HR policies?",
            "What HR software are you familiar with?",
            "Describe a challenging HR scenario you managed."
        ],
        'Data Analyst' => [
            "What tools do you use for data analysis?",
            "Explain correlation vs causation.",
            "How do you clean messy datasets?",
            "What is data normalization?",
            "Explain how you create visualizations.",
            "How do you handle missing or null data?",
            "Explain regression analysis.",
            "How do you interpret a dataset to provide business insights?"
        ],
        'General' => []
    ];

    $extra = $role_questions[$role] ?? [];
    shuffle($extra);
    $_SESSION['questions'] = array_merge($common_questions, $extra);
    $_SESSION['questions'] = array_slice($_SESSION['questions'], 0, 8); // select 8 random questions
}

$role = $_SESSION['interview_role'] ?? 'General';
$questions = $_SESSION['questions'] ?? ["Tell me about yourself."];
$qIndex = $_SESSION['question_index'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['voice_answer'])) {
    $answer = $_POST['voice_answer'];
    $question = $questions[$qIndex];

    $stmt = $conn->prepare("INSERT INTO interview_responses (user_id, role, question, answer) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $role, $question, $answer);
    $stmt->execute();
    $stmt->close();

    $_SESSION['question_index']++;
    echo json_encode(['next' => true]);
    exit;
}

if ($qIndex >= count($questions)) {
    echo "<h2>Interview for <b>$role</b> Completed!</h2>";
    echo "<p>✅ All answers are saved in database.</p>";
    echo "<a href='select_role.php'>Try Another Role</a>";
    session_unset();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>AI Interview - <?= htmlspecialchars($role) ?></title>
    <style>
        body { font-family: Arial; text-align: center; background-color: #f9f9f9; padding: 30px; }
        .btn { width: 180px; height: 45px; background: rgb(84, 236, 140); border-radius: 40px; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600; margin: 10px; border: none; }
        img.avatar { width: 150px; border-radius: 50%; animation: speak 1s infinite alternate; }
        @keyframes speak { 0% { transform: scale(1); } 100% { transform: scale(1.05); } }
    </style>
</head>
<body>
    <h2>👩 Virtual Interviewer - <?= htmlspecialchars($role) ?></h2>
    <img src="image/interview.png" class="avatar" alt="Interviewer" />

    <p id="questionText"></p>
    <button class="btn" onclick="startVoiceInput()">🎤 Speak Answer</button>
    <button class="btn" id="nextBtn" style="display:none;" onclick="submitAnswer()">✅ Next</button>

    <p id="status">Click and speak clearly into your mic. You have 2 minutes per question.</p>
    <p><b>Your Answer:</b> <span id="liveText"></span></p>

    <script>
        const questions = <?= json_encode($questions) ?>;
        let qIndex = <?= $qIndex ?>;
        let currentAnswer = "";

        function speak(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.pitch = 1.1;
            utterance.rate = 0.95;
            speechSynthesis.speak(utterance);
        }

        function startVoiceInput() {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.interimResults = true;

            document.getElementById("status").innerText = "🎙️ Listening for 2 minutes...";

            recognition.onresult = function(event) {
                let transcript = "";
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    transcript += event.results[i][0].transcript + " ";
                }
                currentAnswer = transcript.trim();
                document.getElementById("liveText").innerText = currentAnswer;
            };

            recognition.onend = function() {
                document.getElementById("status").innerText = "✅ You can click Next to submit your answer.";
                document.getElementById("nextBtn").style.display = "inline-block";
            };

            recognition.onerror = function(event) {
                document.getElementById("status").innerText = "Error: " + event.error;
            };

            recognition.start();

            // Stop recognition automatically after 2 minutes
            setTimeout(() => {
                recognition.stop();
            }, 2 * 60 * 1000);
        }

        function submitAnswer() {
            if (!currentAnswer.trim()) { alert("Please speak your answer before clicking Next."); return; }

            fetch("", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: "voice_answer=" + encodeURIComponent(currentAnswer)
            })
            .then(res => res.json())
            .then(data => {
                if (data.next) location.reload();
            });
        }

        window.onload = function() {
            const question = questions[qIndex];
            document.getElementById("questionText").innerText = question;
            speak(question);
        };
    </script>
</body>
</html>
