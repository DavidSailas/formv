<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header("Location: index.php"); 
    exit;
}

$form_data = $_SESSION['form_data'];

$dob = new DateTime($form_data['dob']);
$today = new DateTime();
$age = $today->diff($dob)->y;

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: white;
            padding: 2rem;
        }
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw; 
            height: 100vh; 
            object-fit: cover; 
            z-index: -1; 
        }
        .data-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .data-title {
            text-align: center;
            font-size: 1.8rem;
            margin: 1.5rem 0;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 0.5rem;
        }
        .data-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.05);
            transition: background 0.3s;
        }
        .data-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .data-item strong {
            width: 250px; 
            text-align: left; 
            font-weight: bold;
        }
        .section {
            margin-bottom: 2rem;
            padding: 1rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
        }

.btn {
    font-weight: bold;
    padding: 10px 16px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-add {
    background-color: #3b82f6; /* Blue */
}

.btn-add:hover {
    background-color: #2563eb;
}

.btn-edit {
    background-color: #10b981; /* Green */
}

.btn-edit:hover {
    background-color: #059669;
}

    </style>
</head>
<body>

<video autoplay muted loop id="bg-video"> 
    <source src="bg/bgv.mp4" type="video/mp4"> 
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
    <a href="index.php" class="btn btn-add mr-4">
        <i class="fas fa-plus"></i> Add
    </a>
    <a href="DBtable.php" class="btn btn-edit">
        <i class="fas fa-edit"></i> Edit
    </a>
</div>

</div>
</body>
</html>