<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Interview Role</title>
</head>
<body>
    <h2>Select a Job Role for Mock Interview</h2>
    <form action="ai_interview.php" method="POST">
        <select name="role" required>
            <option value="">-- Select Role --</option>
            <option value="Web Developer">Web Developer</option>
            <option value="HR Manager">HR Manager</option>
            <option value="Data Analyst">Data Analyst</option>
        </select>
        <button type="submit">Start Interview</button>
    </form>
</body>
</html>
