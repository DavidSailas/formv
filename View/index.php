<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/formv/Controller/UserController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/formv/Model/db_connect.php';

// Initialize the UserController
$controller = new UserController($conn);
$controller->handleRequest();

// Extract form data and errors from session
$form_data = $_SESSION['form_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];

// Unset session variables after use
unset($_SESSION['form_data']);
unset($_SESSION['errors']);

// Create a User object with the processed data
$user = new User($form_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/formv/Css/style.css">
    <title>Registration Form</title>
    <style>
        .error { color: red; }
    </style>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/formv/Model/scriptlocation.php'; ?>
    <script>
        function toggleOtherInput() {
            const civilStatus = document.getElementById('civil-status').value;
            const otherInput = document.getElementById('others-input');
            otherInput.style.display = civilStatus === 'Others' ? 'block' : 'none';
        }
    </script> 
</head>
<body>
<video autoplay muted loop id="bg-video"> 
    <source src="/formv/bg/bgv.mp4" type="video/mp4"> 
</video>

<div class="wrapper">
    <h1>PERSONAL DATA</h1>

    <form action="" method="post">
        <div class="input-container">
            <div class="input-box">
                <p>Last Name</p>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user->last_name); ?>" >
                <?php if (isset($errors['last_name'])): ?>
                    <span class="error"><?php echo $errors['last_name']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>First Name</p>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user->first_name); ?>" >
                <?php if (isset($errors['first_name'])): ?>
                    <span class="error"><?php echo $errors['first_name']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Middle Name</p>
                <input type="text" name="middle_name" value="<?php echo htmlspecialchars($user->middle_name); ?>">
                <?php if (isset($errors['middle_name'])): ?>
                    <span class="error"><?php echo $errors['middle_name']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Date of Birth</p>
                <input type="date" name="dob" value="<?php echo htmlspecialchars($user->dob); ?>" >
                <?php if (isset($errors['dob'])): ?>
                    <span class="error"><?php echo $errors['dob']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-radio">
                <p>Sex</p>
                <label><input type="radio" name="sex" value="Male" <?php echo ($user->sex === 'Male') ? 'checked' : ''; ?> > Male</label>
                <label><input type="radio" name="sex" value="Female" <?php echo ($user->sex === 'Female') ? 'checked' : ''; ?> > Female</label>
                <?php if (isset($errors['sex'])): ?>
                    <span class="error"><?php echo $errors['sex']; ?></span>
                <?php endif; ?>
            </div>

            <div class="input-box">
                <p>Civil Status</p>
                <select id="civil-status" name="civil_status" onchange="toggleOtherInput()">
                    <option value="">Select</option>
                    <option value="Single" <?php echo ($user->civil_status === 'Single') ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo ($user->civil_status === 'Married') ? 'selected' : ''; ?>>Married</option>
                    <option value="Widowed" <?php echo ($user->civil_status === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                    <option value="Legally Separated" <?php echo ($user->civil_status === 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                    <option value="Others" <?php echo ($user->civil_status === 'Others') ? 'selected' : ''; ?>>Others</option>
                </select>
                <?php if (isset($errors['civil_status'])): ?>
                    <span class="error"><?php echo $errors['civil_status']; ?></span>
                <?php endif; ?>
                <input type="text" id="others-input" name="civil_status_other" placeholder="Please specify" style="display: <?php echo ($user->civil_status === 'Others') ? 'block' : 'none'; ?>;">
                <?php if (isset($errors['civil_status_other'])): ?>
                    <span class="error"><?php echo $errors['civil_status_other']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Tax Identification Number</p>
                <input type="text" name="tax_id" value="<?php echo htmlspecialchars($user->tax_id); ?>" >
                <?php if (isset($errors['tax_id'])): ?>
                    <span class="error"><?php echo $errors['tax_id']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Nationality</p>
                <input type="text" name="nationality" value="<?php echo htmlspecialchars($user->nationality); ?>" >
                <?php if (isset($errors['nationality'])): ?>
                    <span class="error"><?php echo $errors['nationality']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Religion</p>
                <input type="text" name="religion" value="<?php echo htmlspecialchars($user->religion); ?>" >
                <?php if (isset($errors['religion'])): ?>
                    <span class="error"><?php echo $errors['religion']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="line"></div>

        <h1>PLACE OF BIRTH</h1>

        <div class="input-container">
            <div class="input-box">
                <p>RM/FLR/Unit No. & Bldg. Name</p>
                <input type="text" name="unit_bldg" value="<?php echo htmlspecialchars($user->unit_bldg); ?>" >
                <?php if (isset($errors['unit_bldg'])): ?>
                    <span class="error"><?php echo $errors['unit_bldg']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>House/Lot & Blk. No</p>
                <input type="text" name="house_lot" value="<?php echo htmlspecialchars($user->house_lot); ?>" >
                <?php if (isset($errors['house_lot'])): ?>
                    <span class="error"><?php echo $errors['house_lot']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Street Name</p>
                <input type="text" name="street" value="<?php echo htmlspecialchars($user->street); ?>" >
                <?php if (isset($errors['street'])): ?>
                    <span class="error"><?php echo $errors['street']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Subdivision</p>
                <input type="text" name="subdivision" value="<?php echo htmlspecialchars($user->subdivision); ?>" >
                <?php if (isset($errors['subdivision'])): ?>
                    <span class="error"><?php echo $errors['subdivision']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Barangay/District/Locality</p>
                <input type="text" name="barangay" value="<?php echo htmlspecialchars($user->barangay); ?>" >
                <?php if (isset($errors['barangay'])): ?>
                    <span class="error"><?php echo $errors['barangay']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>City/Municipality</p>
                <input type="text" name="city" value="<?php echo htmlspecialchars($user->city); ?>" >
                <?php if (isset($errors['city'])): ?>
                    <span class="error"><?php echo $errors['city']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Province</p>
                <input type="text" name="province" value="<?php echo htmlspecialchars($user->province); ?>" >
                <?php if (isset($errors['province'])): ?>
                    <span class="error"><?php echo $errors['province']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Country</p>
                <select name="country" >
                    <?php echo User::getCountryOptions($user->country); ?>
                </select>
                <?php if (isset($errors['country'])): ?>
                    <span class="error"><?php echo $errors['country']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Zip Code</p>
                <input type="text" name="zip_code" value="<?php echo htmlspecialchars($user->zip_code); ?>" >
                <?php if (isset($errors['zip_code'])): ?>
                    <span class="error"><?php echo $errors['zip_code']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="line"></div>

        <h1>HOME ADDRESS</h1>

        <div class="input-container">
            <div class="input-box">
                <p>RM/FLR/Unit No. & Bldg. Name</p>
                <input type="text" name="home_unit_bldg" value="<?php echo htmlspecialchars($user->home_unit_bldg); ?>" >
                <?php if (isset($errors['home_unit_bldg'])): ?>
                    <span class="error"><?php echo $errors['home_unit_bldg']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>House/Lot & Blk. No</p>
                <input type="text" name="home_house_lot" value="<?php echo htmlspecialchars($user->home_house_lot); ?>" >
                <?php if (isset($errors['home_house_lot'])): ?>
                    <span class="error"><?php echo $errors['home_house_lot']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Street Name</p>
                <input type="text" name="home_street" value="<?php echo htmlspecialchars($user->home_street); ?>" >
                <?php if (isset($errors['home_street'])): ?>
                    <span class="error"><?php echo $errors['home_street']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Subdivision</p>
                <input type="text" name="home_subdivision" value="<?php echo htmlspecialchars($user->home_subdivision); ?>" >
                <?php if (isset($errors['home_subdivision'])): ?>
                    <span class="error"><?php echo $errors['home_subdivision']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Barangay/District/Locality</p>
                <input type="text" name="home_barangay" value="<?php echo htmlspecialchars($user->home_barangay); ?>" >
                <?php if (isset($errors['home_barangay'])): ?>
                    <span class="error"><?php echo $errors['home_barangay']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>City/Municipality</p>
                <input type="text" name="home_city" value="<?php echo htmlspecialchars($user->home_city); ?>" >
                <?php if (isset($errors['home_city'])): ?>
                    <span class="error"><?php echo $errors['home_city']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <p>Province</p>
                <input type="text" name="home_province" value="<?php echo htmlspecialchars($user->home_province); ?>" >
                <?php if (isset($errors['home_province'])): ?>
                    <span class="error"><?php echo $errors['home_province']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Country</p>
                <select name="home_country" >
                    <?php echo User::getCountryOptions($user->home_country); ?>
                </select>
                <?php if (isset($errors['home_country'])): ?>
                    <span class="error"><?php echo $errors['home_country']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Zip Code</p>
                <input type="text" name="home_zip_code" value="<?php echo htmlspecialchars($user->home_zip_code); ?>" >
                <?php if (isset($errors['home_zip_code'])): ?>
                    <span class="error"><?php echo $errors['home_zip_code']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="line"></div>

        <h2>Contact Info</h2>
        <div class="input-container">
            <div class="input-box">
                <p>Mobile/Cellphone Number</p>
                <input type="text" name="mobile_no" value="<?php echo htmlspecialchars($user->mobile_no); ?>" >
                <?php if (isset($errors['mobile_no'])): ?>
                    <span class="error"><?php echo $errors['mobile_no']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Email Address</p>
                <input type="text" name="email_address" value="<?php echo htmlspecialchars($user->email_address); ?>" >
                <?php if (isset($errors['email_address'])): ?>
                    <span class="error"><?php echo $errors['email_address']; ?></span>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <p>Telephone Number</p>
                <input type="text" name="telephone_no" value="<?php echo htmlspecialchars($user->telephone_no); ?>" >
                <?php if (isset($errors['telephone_no'])): ?>
                    <span class="error"><?php echo $errors['telephone_no']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <h2>Father's Name</h2>
        <div class="input-container">
            <div class="input-box">
                <p>Last Name</p>
                <input type="text" name="father_last_name" value="<?php echo htmlspecialchars($user->father_last_name); ?>" >
                <?php if (isset($errors['father_last_name'])) echo '<p class="error">' . $errors['father_last_name'] . '</p>'; ?>
            </div>
            <div class="input-box">
                <p>First Name</p>
                <input type="text" name="father_first_name" value="<?php echo htmlspecialchars($user->father_first_name); ?>" >
                <?php if (isset($errors['father_first_name'])) echo '<p class="error">' . $errors['father_first_name'] . '</p>'; ?>
            </div>
            <div class="input-box">
                <p>Middle Initial</p>
                <input type="text" name="father_middle_initial" value="<?php echo htmlspecialchars($user->father_middle_initial); ?>">
                <?php if (isset($errors['father_middle_initial'])) echo '<p class="error">' . $errors['father_middle_initial'] . '</p>'; ?>
            </div>
        </div>

        <h2>Mother's Name</h2>
        <div class="input-container">
            <div class="input-box">
                <p>Last Name</p>
                <input type="text" name="mother_last_name" value="<?php echo htmlspecialchars($user->mother_last_name); ?>" >
                <?php if (isset($errors['mother_last_name'])) echo '<p class="error">' . $errors['mother_last_name'] . '</p>'; ?>
            </div>
            <div class="input-box">
                <p>First Name</p>
                <input type="text" name="mother_first_name" value="<?php echo htmlspecialchars($user->mother_first_name); ?>" >
                <?php if (isset($errors['mother_first_name'])) echo '<p class="error">' . $errors['mother_first_name'] . '</p>'; ?>
            </div>
            <div class="input-box">
                <p>Middle Initial</p>
                <input type="text" name="mother_middle_initial" value="<?php echo htmlspecialchars($user->mother_middle_initial); ?>">
                <?php if (isset($errors['mother_middle_initial'])) echo '<p class="error">' . $errors['mother_middle_initial'] . '</p>'; ?>
            </div>
        </div>

        <button id="next-button" type="submit">Submit</button>
    </form>
</div>
</body>
</html>