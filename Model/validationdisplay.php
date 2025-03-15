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

// Include the functions file
include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/functions.php'; // Adjust the path as necessary
?>