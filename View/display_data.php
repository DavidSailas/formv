<?php
session_start();

// Check if form data was submitted via POST
if (!isset($_SESSION['form_data'])) {
    header("Location: /formv/View/index.php");
    exit;
}

$form_data = $_SESSION['form_data'];

// Calculate age based on date of birth
include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/getbod.php';
$age = calculateAge($form_data['dob']); 

// Unset session data after use
unset($_SESSION['form_data']);

// Include the functions file
include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/functions.php'; // Adjust the path as necessary
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Data</title>
    <link rel="stylesheet" href="/formv/Css/style_displaydata.css">
</head>
<body>

<video autoplay muted loop id="bg-video"> 
    <source src="/formv/bg/bgv.mp4" type="video/mp4"> 
</video>

<div class="data-container">
    <div class="data-title">Personal Information</div>
    <div class="data-item"><strong>Name:</strong> <?php echo displayValue(formatName($form_data['last_name'], $form_data['first_name'], $form_data['middle_name'])); ?></div>
    <div class="data-item"><strong>Age:</strong> <?php echo $age; ?></div>
    <div class="data-item"><strong>Date of Birth:</strong> <?php echo displayValue($form_data['dob']); ?></div>
    <div class="data-item"><strong>Sex:</strong> <?php echo displayValue($form_data['sex']); ?></div>
    <div class="data-item"><strong>Civil Status:</strong> <?php echo displayValue($form_data['civil_status'] === 'Others' ? $form_data['civil_status_other'] : $form_data['civil_status']); ?></div>
    <div class="data-item"><strong>Tax ID:</strong> <?php echo displayValue($form_data['tax_id']); ?></div>
    <div class="data-item"><strong>Nationality:</strong> <?php echo displayValue($form_data['nationality']); ?></div>
    <div class="data-item"><strong>Religion:</strong> <?php echo displayValue($form_data['religion']); ?></div>

    <div class="data-title"> Place of Birth</div>
    <div class="data-item"><strong>RM/FLR/Unit No. & Bldg. Name:</strong> <?php echo displayValue($form_data['unit_bldg']); ?></div>
    <div class="data-item"><strong>House/Lot & Blk. No:</strong> <?php echo displayValue($form_data['house_lot']); ?></div>
    <div class="data-item"><strong>Street Name:</strong> <?php echo displayValue($form_data['street']); ?></div>
    <div class="data-item"><strong>Subdivision:</strong> <?php echo displayValue($form_data['subdivision']); ?></div>
    <div class="data-item"><strong>Barangay/District/Locality:</strong> <?php echo displayValue($form_data['barangay']); ?></div>
    <div class="data-item"><strong>City/Municipality:</strong> <?php echo displayValue($form_data['city']); ?></div>
    <div class="data-item"><strong>Province:</strong> <?php echo displayValue($form_data['province']); ?></div>
    <div class="data-item"><strong>Country:</strong> <?php echo displayValue($form_data['country']); ?></div>
    <div class="data-item"><strong>Zip Code:</strong> <?php echo displayValue($form_data['zip_code']); ?></div>

    <div class="data-title">Home Address</div>
    <div class="data-item"><strong>RM/FLR/Unit No. & Bldg. Name:</strong> <?php echo displayValue($form_data['home_unit_bldg']); ?></div>
    <div class="data-item"><strong>House/Lot & Blk. No:</strong> <?php echo displayValue($form_data['home_house_lot']); ?></div>
    <div class="data-item"><strong>Street Name:</strong> <?php echo displayValue($form_data['home_street']); ?></div>
    <div class="data-item"><strong>Subdivision:</strong> <?php echo displayValue($form_data['home_subdivision']); ?></div>
    <div class="data-item"><strong>Barangay/District/Locality:</strong> <?php echo displayValue($form_data['home_barangay']); ?></div>
    <div class="data-item"><strong>City/Municipality:</strong> <?php echo displayValue($form_data['home_city']); ?></div>
    <div class="data-item"><strong>Province:</strong> <?php echo displayValue($form_data['home_province']); ?></div>
    <div class="data-item"><strong>Country:</strong> <?php echo displayValue($form_data['home_country']); ?></div>
    <div class="data-item"><strong>Zip Code:</strong> <?php echo displayValue($form_data['home_zip_code']); ?></div>

    <div class="data-title">Contact Data</div>
    <div class="data-item"><strong>Mobile / Cellphone Number:</strong> <?php echo displayValue($form_data['mobile_no']); ?></div>
    <div class="data-item"><strong>E-mail Address:</strong> <?php echo displayValue($form_data['email_address']); ?></div>
    <div class="data-item"><strong>Telephone Number:</strong> <?php echo displayValue($form_data['telephone_no']); ?></div>

    <div class="data-title">Parents Name</div>
    <div class="data-item"><strong>Father:</strong> <?php echo displayValue(formatName($form_data['father_last_name'], $form_data['father_first_name'], $form_data['father_middle_initial'])); ?></div>
    <div class="data-item"><strong>Mother:</strong> <?php echo displayValue(formatName($form_data['mother_last_name'], $form_data['mother_first_name'], $form_data['mother_middle_initial'])); ?></div>

<div class="flex justify-center mt-8">
    <a href="/formv/View/index.php" class="btn btn-add mr-4">
        <i class="fas fa-plus"></i> Add
    </a>
    <a href="/formv/View/DBtable.php" class="btn btn-edit">
        <i class="fas fa-edit"></i> Edit
    </a>
</div>

</div>
</body>
</html>