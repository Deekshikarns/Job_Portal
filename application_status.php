<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];
    $status = $_POST['status'];

    $query = "UPDATE applications SET status='$status' WHERE id='$application_id'";

    if (mysqli_query($conn, $query)) {
        echo "<p>Status updated successfully!</p>";
    } else {
        echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
