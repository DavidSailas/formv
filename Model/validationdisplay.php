<?php 
session_start();
if (!isset($_SESSION['form_data'])) {
    header("Location: /formv/View/index.php"); 
    exit;
}

$form_data = $_SESSION['form_data'];

include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/getbod.php';

$age = calculateAge($form_data['dob']); 

unset($_SESSION['form_data']);

function formatName($last_name, $first_name, $middle) {
    // Trim the inputs
    $last_name = trim($last_name);
    $first_name = trim($first_name);
    $middle = trim($middle);

    // Check if any name component is "N/A"
    if (strcasecmp($last_name, "N/A") === 0 || strcasecmp($first_name, "N/A") === 0 || strcasecmp($middle, "N/A") === 0) {
        return ""; // Return empty if any part is "N/A"
    }

    // Format the middle initial if it's not empty
    if (!empty($middle)) {
        $middle = substr($middle, 0, 1) . '.'; 
    } else {
        $middle = ""; // If middle name is empty, set it to empty
    }

    return trim($last_name . ', ' . $first_name . ' ' . $middle);
}

// Function to display values, replacing "N/A" with an empty string
function displayValue($value) {
    return ($value === "N/A") ? "" : htmlspecialchars($value);
}
?>