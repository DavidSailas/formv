<?php
// Handle DELETE request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $deleteQuery = "DELETE FROM user_table WHERE user_id = '$user_id'";
    mysqli_query($conn, $deleteQuery);
    echo 'Record deleted successfully'; // Return success message
    exit();
}

// Fetch records from the database
$query = "SELECT user_id, last_name, first_name, middle_name, dob, sex FROM user_table";
$result = mysqli_query($conn, $query);
?>