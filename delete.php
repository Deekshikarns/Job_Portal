<?php
session_start();
include "connect.php"; // Include your database connection

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If user confirmed deletion
    if (isset($_POST['confirm_delete'])) {
        $delete_query = "DELETE FROM signup WHERE id = ? ";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            session_destroy(); 
            header("Location: goodbye.php"); 
            exit;
        } else {
            echo "Error deleting account!";
        }
    } else {
        // User canceled deletion
        header("Location: home.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h2>Are you sure you want to delete your account?</h2>
    <form method="post">
        <button type="submit" name="confirm_delete">Yes, Delete My Account</button>
        <a href="home.php">Cancel</a>
    </form>
</body>
</html>
