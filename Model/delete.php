<?php
// Handle DELETE request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_ids = $_POST['user_ids']; // This will be a comma-separated string
    $user_ids_array = explode(',', $user_ids); // Convert to an array

    // Prepare the SQL statement
    $ids_to_delete = implode(',', array_map('intval', $user_ids_array)); // Sanitize input
    $deleteQuery = "DELETE FROM user_table WHERE user_id IN ($ids_to_delete)";
    
    if (mysqli_query($conn, $deleteQuery)) {
        echo 'Records deleted successfully'; // Return success message
    } else {
        echo 'Error deleting records: ' . mysqli_error($conn); // Return error message
    }
    exit();
}

// Fetch records from the database
$query = "SELECT user_id, last_name, first_name, middle_name, dob, sex FROM user_table";
$result = mysqli_query($conn, $query);
?>