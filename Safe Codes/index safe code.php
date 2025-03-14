<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime();
    return $today->diff($dob)->y; 
}

// Initialize variables
$last_name = $first_name = $middle_name = $dob = $sex = $civil_status = $civil_status_other = $tax_id = $nationality = $religion = '';
$unit_bldg = $house_lot = $street = $subdivision = $barangay = $city = $province = $country = $zip_code = '';
$mobile_no = $email_address = $telephone_no = $father_last_name = $father_first_name = $father_middle_initial = '';
$mother_last_name = $mother_first_name = $mother_middle_initial = '';
$home_unit_bldg = $home_house_lot = $home_street = $home_subdivision = $home_barangay = $home_city = $home_province = $home_country = $home_zip_code = '';
$errors = [];

// Array of countries
$countries = [
    "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia",
    "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus",
    "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil",
    "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Chile", "China",
    "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
    "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland",
    "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", 
    "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq",
    "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyzstan",
    "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Lithuania", "Luxembourg", "Madagascar", 
    "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia",
    "Morocco", "Mozambique", "Myanmar", "Namibia", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger",
    "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", 
    "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Senegal", "Serbia", "Singapore", "Slovakia",
    "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland",
    "Syria", "Taiwan", "Tanzania", "Thailand", "Tunisia", "Turkey", "Uganda", "Ukraine", "United Kingdom",
    "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
];

// Generate country options
$countryOpt = '<option value="">Select</option>';
foreach ($countries as $c) {
    $countryOpt .= "<option value='$c'" . ($country === $c ? ' selected' : '') . ">$c</option>";
}

// Check if editing a user
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM user_table WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Populate form fields with user data
    if ($user) {
        $last_name = $user['last_name'];
        $first_name = $user['first_name'];
        $middle_name = $user['middle_name'];
        $dob = $user['dob'];
        $sex = $user['sex'];
        $civil_status = $user['civil_status'];
        $tax_id = $user['tax_id'];
        $nationality = $user['nationality'];
        $religion = $user['religion'];
        $unit_bldg = $user['unit_bldg'];
        $house_lot = $user['house_lot'];
        $street = $user['street'];
        $subdivision = $user['subdivision'];
        $barangay = $user['barangay'];
        $city = $user['city'];
        $province = $user['province'];
        $country = $user['country'];
        $zip_code = $user['zip_code'];
        $mobile_no = $user['mobile_no'];
        $email_address = $user['email_address'];
        $telephone_no = $user['telephone_no'];
        $father_last_name = $user['father_last_name'];
        $father_first_name = $user['father_first_name'];
        $father_middle_initial = $user['father_middle_initial'];
        $mother_last_name = $user['mother_last_name'];
        $mother_first_name = $user['mother_first_name'];
        $mother_middle_initial = $user['mother_middle_initial'];
        $home_unit_bldg = $user['home_unit_bldg'];
        $home_house_lot = $user['home_house_lot'];
        $home_street = $user['home_street'];
        $home_subdivision = $user['home_subdivision'];
        $home_barangay = $user['home_barangay'];
        $home_city = $user['home_city'];
        $home_province = $user['home_province'];
        $home_country = $user['home_country'];
        $home_zip_code = $user['home_zip_code'];
    }
}

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = trim($_POST['last_name']);
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $dob = $_POST['dob'];
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $civil_status = $_POST['civil_status'];
    $civil_status_other = trim($_POST['civil_status_other']);
    $tax_id = trim($_POST['tax_id']);
    $nationality = trim($_POST['nationality']);
    $religion = trim($_POST['religion']);
    $unit_bldg = trim($_POST['unit_bldg']);
    $house_lot = trim($_POST['house_lot']);
    $street = trim($_POST['street']);
    $subdivision = trim($_POST['subdivision']);
    $barangay = trim($_POST['barangay']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $country = $_POST['country'];
    $zip_code = trim($_POST['zip_code']);
    $mobile_no = trim($_POST['mobile_no']);
    $email_address = trim($_POST['email_address']);
    $telephone_no = trim($_POST['telephone_no']);
    $father_last_name = trim($_POST['father_last_name']);
    $father_first_name = trim($_POST['father_first_name']);
    $father_middle_initial = trim($_POST['father_middle_initial']);
    $mother_last_name = trim($_POST['mother_last_name']);
    $mother_first_name = trim($_POST['mother_first_name']);
    $mother_middle_initial = trim($_POST['mother_middle_initial']);
    $home_unit_bldg = trim($_POST['home_unit_bldg']);
    $home_house_lot = trim($_POST['home_house_lot']);
    $home_street = trim($_POST['home_street']);
    $home_subdivision = trim($_POST['home_subdivision']);
    $home_barangay = trim($_POST['home_barangay']);
    $home_city = trim($_POST['home_city']);
    $home_province = trim($_POST['home_province']);
    $home_country = $_POST['home_country'];
    $home_zip_code = trim($_POST['home_zip_code']);

    function validateRequiredField($field, $fieldName, &$errors) {
        if (empty($field) || ctype_space($field)) {
            $errors[$fieldName] = "*Field is required.";
        }
    }
    
    function validateNoNumbers($field, $fieldName, &$errors) {
        if (preg_match('/[0-9]/', $field)) {
            $errors[$fieldName] = "*Must not contain numbers.";
        }
    }
    
    function validateNumericField($field, $fieldName, &$errors) {
        if (!preg_match('/^[0-9]+$/', $field)) {
            $errors[$fieldName] = "*Must contain numbers only.";
        }
    }
    
    function validateEmail($email, &$errors) {
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email_address'] = "*Invalid email format.";
        }
    }
    
    function validateAge($dob, &$errors) {
        if (empty($dob)) {
            $errors['dob'] = "*Field is required.";
        } elseif (calculateAge($dob) < 18) {
            $errors['dob'] = "*Must be at least 18 yrs old.";
        }
    }
    
    function validateOptionalField(&$field, $default) {
        if (empty($field) || ctype_space($field)) {
            $field = $default;
        }
    }
    
    // Validations
    validateOptionalField($last_name, '', $errors);
    validateRequiredField($last_name, 'last_name', $errors);
    validateNoNumbers($last_name, 'last_name', $errors);
    
    validateOptionalField($first_name, '', $errors);
    validateRequiredField($first_name, 'first_name', $errors);
    validateNoNumbers($first_name, 'first_name', $errors);
    
    validateOptionalField($middle_name, "N/A");
    validateNoNumbers($middle_name, 'middle_name', $errors);
    
    validateAge($dob, $errors);

    validateRequiredField($sex, 'sex', $errors);

    validateRequiredField($civil_status, 'civil_status', $errors);
    if ($civil_status === 'Others') {
        validateRequiredField($civil_status_other, 'civil_status_other', $errors);
    }

    validateRequiredField($tax_id, 'tax_id', $errors);
    validateOptionalField($tax_id, '', $errors);
    validateNumericField($tax_id, 'tax_id', $errors);

    validateRequiredField($nationality, 'nationality', $errors);
    validateOptionalField($nationality, '', $errors);

    validateOptionalField($religion, '', $errors);

    //Place of birth
    validateOptionalField($unit_bldg, '', $errors);
    validateRequiredField($unit_bldg, 'unit_bldg', $errors);

    validateOptionalField($house_lot, '', $errors);
    validateRequiredField($house_lot, 'house_lot', $errors);

    validateOptionalField($street, '', $errors);
    validateRequiredField($street, 'street', $errors);

    validateOptionalField($subdivision, '', $errors);
    validateOptionalField($barangay, '', $errors);
    validateOptionalField($city, '', $errors);
    validateOptionalField($province, '', $errors);
    validateOptionalField($country, '', $errors);

    validateOptionalField($home_zip_code, '', $errors);
    validateNumericField($zip_code, 'zip_code', $errors);

    //Home address
    validateOptionalField($home_unit_bldg, '', $errors);
    validateRequiredField($home_unit_bldg, 'home_unit_bldg', $errors);

    validateOptionalField($home_house_lot, '', $errors);
    validateRequiredField($home_house_lot, 'home_house_lot', $errors);

    validateOptionalField($home_street, '', $errors);
    validateRequiredField($home_street, 'home_street', $errors);

    validateOptionalField($home_subdivision, '', $errors);
    validateRequiredField($home_subdivision, 'home_subdivision', $errors);

    validateOptionalField($home_barangay, '', $errors);
    validateRequiredField($home_barangay, 'home_barangay', $errors);

    validateOptionalField($home_city, '', $errors);
    validateRequiredField($home_city, 'home_city', $errors);

    validateRequiredField($home_province, 'home_province', $errors);
    validateOptionalField($home_province, '', $errors);

    validateRequiredField($home_country, 'home_country', $errors);
    validateOptionalField($home_country, '', $errors);

    validateRequiredField($home_zip_code, 'home_zip_code', $errors);
    validateOptionalField($home_zip_code, '', $errors);
    validateNumericField($home_zip_code, 'zip_code', $errors);
    
    //contact info
    validateRequiredField($mobile_no, 'mobile_no', $errors);
    validateNumericField($mobile_no, 'mobile_no', $errors);
    validateOptionalField($mobile_no, '', $errors);

    validateEmail($email_address, $errors);
    validateOptionalField($email_address, '', $errors);

    validateOptionalField($telephone_no, '', $errors);
    validateNumericField($telephone_no, 'telephone_no', $errors);
    
    //parent's name
    validateOptionalField($father_last_name, '', $errors);
    validateNoNumbers($father_last_name, 'father_last_name', $errors);
    
    validateOptionalField($father_first_name, '', $errors);
    validateNoNumbers($father_first_name, 'father_first_name', $errors);

    validateOptionalField($father_middle_initial, "N/A");
    validateNoNumbers($father_middle_initial, 'father_middle_initial', $errors);

    validateOptionalField($mother_last_name, '', $errors);
    validateNoNumbers($mother_last_name, 'mother_last_name', $errors);
    
    validateOptionalField($mother_first_name, '', $errors);
    validateNoNumbers($mother_first_name, 'mother_first_name', $errors);

    validateOptionalField($mother_middle_initial, "N/A");
    validateNoNumbers($mother_middle_initial, 'mother_middle_initial', $errors);

    // If no errors, store data in session and redirect
    if (empty($errors)) {
        $_SESSION['form_data'] = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'dob' => $dob,
            'sex' => $sex,
            'civil_status' => $civil_status,
            'civil_status_other' => $civil_status_other,
            'tax_id' => $tax_id,
            'nationality' => $nationality,
            'religion' => $religion,
            'unit_bldg' => $unit_bldg,
            'house_lot' => $house_lot,
            'street' => $street,
            'subdivision' => $subdivision,
            'barangay' => $barangay,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'zip_code' => $zip_code,
            'mobile_no' => $mobile_no,
            'email_address' => $email_address,
            'telephone_no' => $telephone_no,
            'father_last_name' => $father_last_name,
            'father_first_name' => $father_first_name,
            'father_middle_initial' => $father_middle_initial,
            'mother_last_name' => $mother_last_name,
            'mother_first_name' => $mother_first_name,
            'mother_middle_initial' => $mother_middle_initial,
            'home_unit_bldg' => $home_unit_bldg,
            'home_house_lot' => $home_house_lot,
            'home_street' => $home_street,
            'home_subdivision' => $home_subdivision,
            'home_barangay' => $home_barangay,
            'home_city' => $home_city,
            'home_province' => $home_province,
            'home_country' => $home_country,
            'home_zip_code' => $home_zip_code
        ];

    // If no errors, update the record if editing, or insert a new record
    if (empty($errors)) {
        if (isset($_GET['edit'])) {
            $user_id = $_GET['edit'];
            $sql = "UPDATE user_table SET 
                last_name=?, first_name=?, middle_name=?, dob=?, sex=?, civil_status=?, civil_status_other=?, 
                tax_id=?, nationality=?, religion=?, unit_bldg=?, house_lot=?, street=?, subdivision=?, barangay=?, city=?, 
                province=?, country=?, zip_code=?, mobile_no=?, email_address=?, telephone_no=?, 
                father_last_name=?, father_first_name=?, father_middle_initial=?, mother_last_name=?, 
                mother_first_name=?, mother_middle_initial=?, home_unit_bldg=?, home_house_lot=?, 
                home_street=?, home_subdivision=?, home_barangay=?, home_city=?, home_province=?, 
                home_country=?, home_zip_code=?
                WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssssi", 
                $last_name, $first_name, $middle_name, $dob, $sex, $civil_status, 
                $civil_status_other, $tax_id, $nationality, $religion, $unit_bldg, 
                $house_lot, $street, $subdivision, $barangay, $city, $province, $country, 
                $zip_code, $mobile_no, $email_address, $telephone_no, $father_last_name, 
                $father_first_name, $father_middle_initial, $mother_last_name, 
                $mother_first_name, $mother_middle_initial, $home_unit_bldg, 
                $home_house_lot, $home_street, $home_subdivision, $home_barangay, 
                $home_city, $home_province, $home_country, $home_zip_code, $user_id
            );
        } else {
            $sql = "INSERT INTO user_table (
                last_name, first_name, middle_name, dob, sex, civil_status, civil_status_other, 
                tax_id, nationality, religion, unit_bldg, house_lot, street, subdivision, barangay, city, 
                province, country, zip_code, mobile_no, email_address, telephone_no, 
                father_last_name, father_first_name, father_middle_initial, mother_last_name, 
                mother_first_name, mother_middle_initial, home_unit_bldg, home_house_lot, 
                home_street, home_subdivision, home_barangay, home_city, home_province, 
                home_country, home_zip_code
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssss", 
                $last_name, $first_name, $middle_name, $dob, $sex, $civil_status, 
                $civil_status_other, $tax_id, $nationality, $religion, $unit_bldg, 
                $house_lot, $street, $subdivision, $barangay, $city, $province, $country, 
                $zip_code, $mobile_no, $email_address, $telephone_no, $father_last_name, 
                $father_first_name, $father_middle_initial, $mother_last_name, 
                $mother_first_name, $mother_middle_initial, $home_unit_bldg, 
                $home_house_lot, $home_street, $home_subdivision, $home_barangay, 
                $home_city, $home_province, $home_country, $home_zip_code
            );
        }

    
        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            header('Location: display_data.php');
            exit(); 
        } else {
            echo "Error: " . $stmt->error;
        }
    
        // Close the statement
        $stmt->close();
    }
}
    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration Form</title>
    <style>
        .error { color: red; }
    </style>
    <script>
        function autoFillLocation() {
            const cityInput = document.querySelector('input[name="city"]');
            const provinceInput = document.querySelector('input[name="province"]');
            const countrySelect = document.querySelector('select[name="country"]');

            const locationData = {
                'minglanilla': { province: 'Cebu', country: 'Philippines' },
                'cebu city': { province: 'Cebu', country: 'Philippines' },
                'lapu-lapu city': { province: 'Cebu', country: 'Philippines' },
                'toledo city': { province: 'Cebu', country: 'Philippines' },
                'talisay city': { province: 'Cebu', country: 'Philippines' },
                'carcar city': { province: 'Cebu', country: 'Philippines' },
                'lapu-lapu': { province: 'Cebu', country: 'Philippines' },
                'toledo': { province: 'Cebu', country: 'Philippines' },
                'talisay': { province: 'Cebu', country: 'Philippines' },
                'carcar': { province: 'Cebu', country: 'Philippines' },
                'bantayan': { province: 'Cebu', country: 'Philippines' },
                'samboan': { province: 'Cebu', country: 'Philippines' },
                'moalboal': { province: 'Cebu', country: 'Philippines' },
                'dalaguete': { province: 'Cebu', country: 'Philippines' },
                'sogod': { province: 'Cebu', country: 'Philippines' },
                'argao': { province: 'Cebu', country: 'Philippines' },
                'naga': { province: 'Cebu', country: 'Philippines' }, 
                'naga city': { province: 'Cebu', country: 'Philippines' }, 
                'pilar': { province: 'Cebu', country: 'Philippines' },
                'tabuelan': { province: 'Cebu', country: 'Philippines' },
                'balamban': { province: 'Cebu', country: 'Philippines' },
                'carmen': { province: 'Cebu', country: 'Philippines' },
                'consolacion': { province: 'Cebu', country: 'Philippines' },
                'liloan': { province: 'Cebu', country: 'Philippines' },
                'san fernando': { province: 'Cebu', country: 'Philippines' },
                'santa fe': { province: 'Cebu', country: 'Philippines' },
                'tabogon': { province: 'Cebu', country: 'Philippines' },
                'dumanjug': { province: 'Cebu', country: 'Philippines' },
                'santa catalina': { province: 'Cebu', country: 'Philippines' },
                'aloguinsan': { province: 'Cebu', country: 'Philippines' },
                'bogo city': { province: 'Cebu', country: 'Philippines' },
                'cordova': { province: 'Cebu', country: 'Philippines' },
                'mactan': { province: 'Cebu', country: 'Philippines' },
                'santa rosa': { province: 'Cebu', country: 'Philippines' }, 
                'sogod': { province: 'Cebu', country: 'Philippines' }, 
                'tuburan': { province: 'Cebu', country: 'Philippines' },
                'manila': { province: 'Metro Manila', country: 'Philippines' },
                'quezon city': { province: 'Metro Manila', country: 'Philippines' },
                'makati': { province: 'Metro Manila', country: 'Philippines' },
                'taguig': { province: 'Metro Manila', country: 'Philippines' },
                'pasig': { province: 'Metro Manila', country: 'Philippines' },
                'caloocan': { province: 'Metro Manila', country: 'Philippines' },
                'davao city': { province: 'Davao del Sur', country: 'Philippines' },
                'cebu city': { province: 'Cebu', country: 'Philippines' },
                'iloilo city': { province: 'Iloilo', country: 'Philippines' },
                'bacolod': { province: 'Negros Occidental', country: 'Philippines' },
                'zamboanga city': { province: 'Zamboanga del Sur', country: 'Philippines' },
                'cagayan de oro': { province: 'Misamis Oriental', country: 'Philippines' },
                'general santos': { province: 'South Cotabato', country: 'Philippines' },
                'antipolo': { province: 'Rizal', country: 'Philippines' },
                'san fernando': { province: 'Pampanga', country: 'Philippines' },
                'baguio': { province: 'Benguet', country: 'Philippines' },
                'dagupan': { province: 'Pangasinan', country: 'Philippines' },
                'tarlac city': { province: 'Tarlac', country: 'Philippines' },
                'san pablo': { province: 'Laguna', country: 'Philippines' },
                'batangas city': { province: 'Batangas', country: 'Philippines' },
                'lucena': { province: 'Quezon', country: 'Philippines' },
                'naga city': { province: 'Camarines Sur', country: 'Philippines' },
                'legazpi': { province: 'Albay', country: 'Philippines' },
                'sorsogon city': { province: 'Sorsogon', country: 'Philippines' },
                'tacloban': { province: 'Leyte', country: 'Philippines' },
                'orlando': { province: 'Eastern Samar', country: 'Philippines' },
                'rodriguez': { province: 'Rizal', country: 'Philippines' },
                'marikina': { province: 'Metro Manila', country: 'Philippines' },
                'muntinlupa': { province: 'Metro Manila', country: 'Philippines' },
                'paranaque': { province: 'Metro Manila', country: 'Philippines' },
                'pasay': { province: 'Metro Manila', country: 'Philippines' },
                'bataan': { province: 'Bataan', country: 'Philippines' },
                'bulacan': { province: 'Bulacan', country: 'Philippines' },
                'pampanga': { province: 'Pampanga', country: 'Philippines' },
                'tarlac': { province: 'Tarlac', country: 'Philippines' },
                'ilocos norte': { province: 'Ilocos Norte', country: 'Philippines' },
                'ilocos sur': { province: 'Ilocos Sur', country: 'Philippines' },
                'la union': { province: 'La Union', country: 'Philippines' },
                'pangasinan': { province: 'Pangasinan', country: 'Philippines' },
                'batanes': { province: 'Batanes', country: 'Philippines' },
                'apayao': { province: 'Apayao', country: 'Philippines' },
                'kalinga': { province: 'Kalinga', country: 'Philippines' },
                'mount province': { province: 'Mountain Province', country: 'Philippines' },
                'ifugao': { province: 'Ifugao', country: 'Philippines' },
                'nueva vizcaya': { province: 'Nueva Vizcaya', country: 'Philippines' },
                'quirino': { province: 'Quirino', country: 'Philippines' },
                'aurora': { province: 'Aurora', country: 'Philippines' },
                'zambales': { province: 'Zambales', country: 'Philippines' },
                'cavite': { province: 'Cavite', country: 'Philippines' },
                'laguna': { province: 'Laguna', country: 'Philippines' },
                'batangas': { province: 'Batangas', country: 'Philippines' },
                'quezon': { province: 'Quezon', country: 'Philippines' },
                'marinduque': { province: 'Marinduque', country: 'Philippines' },
                'romblon': { province: 'Romblon', country: 'Philippines' },
                'masbate': { province: 'Masbate', country: 'Philippines' },
                'albay': { province: 'Albay', country: 'Philippines' },
                'sorsogon': { province: 'Sorsogon', country: 'Philippines' },
                'leyte': { province: 'Leyte', country: 'Philippines' },
                'biliran': { province: 'Biliran', country: 'Philippines' },
                'samar': { province: 'Samar', country: 'Philippines' },
                'eastern samar': { province: 'Eastern Samar', country: 'Philippines' },
                'northern samar': { province: 'Northern Samar', country: 'Philippines' },
                'western samar': { province: 'Western Samar', country: 'Philippines' },
                'negros oriental': { province: 'Negros Oriental', country: 'Philippines' },
                'negros occidental': { province: 'Negros Occidental', country: 'Philippines' },
                'cebu': { province: 'Cebu', country: 'Philippines' },
                'bohol': { province: 'Bohol', country: 'Philippines' },
                'siquijor': { province: 'Siquijor', country: 'Philippines' },
                'davao del norte': { province: 'Davao del Norte', country: 'Philippines' },
                'davao de oro': { province: 'Davao de Oro', country: 'Philippines' },
                'davao del sur': { province: 'Davao del Sur', country: 'Philippines' },
                'south cotabato': { province: 'South Cotabato', country: 'Philippines' },
                'sultan kudarat': { province: 'Sultan Kudarat', country: 'Philippines' },
                'cotabato': { province: 'Cotabato', country: 'Philippines' },
                'zamboanga del norte': { province: 'Zamboanga del Norte', country: 'Philippines' },
                'zamboanga del sur': { province: 'Zamboanga del Sur', country: 'Philippines' },
                'zamboanga sibugay': { province: 'Zamboanga Sibugay', country: 'Philippines' },
                'misamis oriental': { province: 'Misamis Oriental', country: 'Philippines' },
                'misamis occidental': { province: 'Misamis Occidental', country: 'Philippines' },
                'lanao del norte': { province: 'Lanao del Norte', country: 'Philippines' },
                'lanao del sur': { province: 'Lanao del Sur', country: 'Philippines' },
                'bukidnon': { province: 'Bukidnon', country: 'Philippines' },
                'agusan del norte': { province: 'Agusan del Norte', country: 'Philippines' },
                'agusan del sur': { province: 'Agusan del Sur', country: 'Philippines' },
                'surigao del norte': { province: 'Surigao del Norte', country: 'Philippines' },
                'surigao del sur': { province: 'Surigao del Sur', country: 'Philippines' },
                'butuan': { province: 'Agusan del Norte', country: 'Philippines' },
                'caraga': { province: 'Caraga', country: 'Philippines' },
                'ncr': { province: 'National Capital Region', country: 'Philippines' },
                'tokyo': { province: 'Tokyo Metropolis', country: 'Japan' },
                'osaka': { province: 'Osaka Prefecture', country: 'Japan' },
                'new york': { province: 'New York', country: 'United States' },
                'los angeles': { province: 'California', country: 'United States' },
                'london': { province: 'Greater London', country: 'United Kingdom' },
                'paris': { province: 'Île-de-France', country: 'France' },
                'berlin': { province: 'Berlin', country: 'Germany' },
                'sydney': { province: 'New South Wales', country: 'Australia' },
                'toronto': { province: 'Ontario', country: 'Canada' },
                'vancouver': { province: 'British Columbia', country: 'Canada' },
                'mumbai': { province: 'Maharashtra', country: 'India' },
                'delhi': { province: 'Delhi', country: 'India' },
                'beijing': { province: 'Beijing', country: 'China' },
                'shanghai': { province: 'Shanghai', country: 'China' },
                'cairo': { province: 'Cairo', country: 'Egypt' },
                'nairobi': { province: 'Nairobi', country: 'Kenya' },
                'moscow': { province: 'Moscow', country: 'Russia' },
                'sao paulo': { province: 'São Paulo', country: 'Brazil' },
                'buenos aires': { province: 'Buenos Aires', country: 'Argentina' },
                'seoul': { province: 'Seoul', country: 'South Korea' },
                'bangkok': { province: 'Bangkok', country: 'Thailand' },
                'jakarta': { province: 'Jakarta', country: 'Indonesia' },
                'mexico city': { province: 'Mexico City', country: 'Mexico' },
                'rome': { province: 'Lazio', country: 'Italy' },
                'madrid': { province: 'Madrid', country: 'Spain' },
                'lisbon': { province: 'Lisbon', country: 'Portugal' },
                'stockholm': { province: 'Stockholm', country: 'Sweden' },
                'oslo': { province: 'Oslo', country: 'Norway' },
                'copenhagen': { province: 'Capital Region', country: 'Denmark' },
                'helsinki': { province: 'Uusimaa', country: 'Finland' },
                'dublin': { province: 'Leinster', country: 'Ireland' },
                'athens': { province: 'Attica', country: 'Greece' },
                'kuala lumpur': { province: 'Federal Territory', country: 'Malaysia' },
                'manama': { province: 'Capital Governorate', country: 'Bahrain' },
                'doha': { province: 'Doha', country: 'Qatar' },
                'abu dhabi': { province: 'Abu Dhabi', country: 'United Arab Emirates' },
                'riyadh': { province: 'Riyadh', country: 'Saudi Arabia' },
                'baghdad': { province: 'Baghdad', country: 'Iraq' },
                'tehran': { province: 'Tehran', country: 'Iran' },
                'islamabad': { province: 'Islamabad', country: 'Pakistan' },
                'lahore': { province: 'Punjab', country: 'Pakistan' },
                'karachi': { province: 'Sindh', country: 'Pakistan' },
                'hanoi': { province: 'Hanoi', country: 'Vietnam' },
                'singapore': { province: 'Central Region', country: 'Singapore' },
                'auckland': { province: 'Auckland', country: 'New Zealand' },
                'wellington': { province: 'Wellington', country: 'New Zealand' },
                'cape town': { province: 'Western Cape', country: 'South Africa' },
                'johannesburg': { province: 'Gauteng', country: 'South Africa' },
                'accra': { province: 'Greater Accra', country: 'Ghana' },
                'lagos': { province: 'Lagos', country: 'Nigeria' },
                'kigali': { province: 'Kigali', country: 'Rwanda' },
                'lima': { province: 'Lima', country: 'Peru' },
                'caracas': { province: 'Caracas', country: 'Venezuela' },
                'santiago': { province: 'Santiago Metropolitan', country: 'Chile' },
                'bogota': { province: 'Bogotá', country: 'Colombia' },
                'quito': { province: 'Pichincha', country: 'Ecuador' },
                'asuncion': { province: 'Asunción', country: 'Paraguay' },
                'montevideo': { province: 'Montevideo', country: 'Uruguay' },
                'san salvador': { province: 'San Salvador', country: 'El Salvador' },
                'managua': { province: 'Managua', country: 'Nicaragua' },
                'tunis': { province: 'Tunis', country: 'Tunisia' },
                'algiers': { province: 'Algiers', country: 'Algeria' },
                'casablanca': { province: 'Casablanca-Settat', country: 'Morocco' },
                'addis ababa': { province: 'Addis Ababa', country: 'Ethiopia' },
                'lilongwe': { province: 'Lilongwe', country: 'Malawi' },
                'harare': { province: 'Harare', country: 'Zimbabwe' },
                'kabul': { province: 'Kabul', country: 'Afghanistan' },
                'dhaka': { province: 'Dhaka', country: 'Bangladesh' },
                'colombo': { province: 'Western', country: 'Sri Lanka' },
                'male': { province: 'Malé', country: 'Maldives' },
                'tbilisi': { province: 'Tbilisi', country: 'Georgia' },
                'yerevan': { province: 'Yerevan', country: 'Armenia' },
                'baku': { province: 'Baku', country: 'Azerbaijan' },
                'astana': { province: 'Nur-Sultan', country: 'Kazakhstan' },
                'bishkek': { province: 'Bishkek', country: 'Kyrgyzstan' },
                'tashkent': { province: 'Tashkent', country: 'Uzbekistan' },
                'ashgabat': { province: 'Ashgabat', country: 'Turkmenistan' },
                'dushanbe': { province: 'Dushanbe', country: 'Tajikistan' },
                'nursultan': { province: 'Akmola Region', country: 'Kazakhstan' },
                'sana': { province: 'Sana\'a', country: 'Yemen' },
                'muscat': { province: 'Muscat', country: 'Oman' }
            };

            cityInput.addEventListener('input', function() {
                const city = cityInput.value.toLowerCase().trim();
                if (locationData[city]) {
                    provinceInput.value = locationData[city].province;
                    countrySelect.value = locationData[city].country;
                } else {
                    provinceInput.value = ''; 
                    countrySelect.value = ''; 
                }
            });
        }

        document.addEventListener('DOMContentLoaded', autoFillLocation);
    </script>

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
        <source src="bg/bgv.mp4" type="video/mp4"> 
    </video>

    <div class="wrapper">
        <h1>PERSONAL DATA</h1>

        <form action="" method="post">
            <div class="input-container">
                <div class="input-box">
                    <p>Last Name</p>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" >
                    <?php if (isset($errors['last_name'])): ?>
                        <span class="error"><?php echo $errors['last_name']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>First Name</p>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" >
                    <?php if (isset($errors['first_name'])): ?>
                        <span class="error"><?php echo $errors['first_name']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Middle Name</p>
                    <input type="text" name="middle_name" value="<?php echo htmlspecialchars($middle_name); ?>">
                    <?php if (isset($errors['middle_name'])): ?>
                        <span class="error"><?php echo $errors['middle_name']; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Date of Birth</p>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>" >
                    <?php if (isset($errors['dob'])): ?>
                        <span class="error"><?php echo $errors['dob']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-radio">
    <p>Sex</p>
    <label><input type="radio" name="sex" value="Male" <?php echo ($sex === 'Male') ? 'checked' : ''; ?> > Male</label>
    <label><input type="radio" name="sex" value="Female" <?php echo ($sex === 'Female') ? 'checked' : ''; ?> > Female</label>
    <?php if (isset($errors['sex'])): ?>
        <span class="error"><?php echo $errors['sex']; ?></span> <!-- Display error for sex -->
    <?php endif; ?>
</div>

<div class="input-box">
    <p>Civil Status</p>
    <select id="civil-status" name="civil_status" onchange="toggleOtherInput()">
        <option value="">Select</option>
        <option value="Single" <?php echo ($civil_status === 'Single') ? 'selected' : ''; ?>>Single</option>
        <option value="Married" <?php echo ($civil_status === 'Married') ? 'selected' : ''; ?>>Married</option>
        <option value="Widowed" <?php echo ($civil_status === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
        <option value="Legally Separated" <?php echo ($civil_status === 'Legally Separated') ? 'selected': ''; ?>>Legally Separated</option>
        <option value="Others" <?php echo ($civil_status === 'Others') ? 'selected' : ''; ?>>Others</option>
    </select>
    <?php if (isset($errors['civil_status'])): ?>
        <span class="error"><?php echo $errors['civil_status']; ?></span> <!-- Display error for civil status -->
    <?php endif; ?>
    <input type="text" id="others-input" name="civil_status_other" placeholder="Please specify" style="display: <?php echo ($civil_status === 'Others') ? 'block' : 'none'; ?>;">
    <?php if (isset($errors['civil_status_other'])): ?>
        <span class="error"><?php echo $errors['civil_status_other']; ?></span>
    <?php endif; ?>
</div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Tax Identification Number</p>
                    <input type="text" name="tax_id" value="<?php echo htmlspecialchars($tax_id); ?>" >
                    <?php if (isset($errors['tax_id'])): ?>
                        <span class="error"><?php echo $errors['tax_id']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Nationality</p>
                    <input type="text" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>" >
                    <?php if (isset($errors['nationality'])): ?>
                        <span class="error"><?php echo $errors['nationality']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Religion</p>
                    <input type="text" name="religion" value="<?php echo htmlspecialchars($religion); ?>" >
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
                    <input type="text" name="unit_bldg" value="<?php echo htmlspecialchars($unit_bldg); ?>" >
                    <?php if (isset($errors['unit_bldg'])): ?>
                        <span class="error"><?php echo $errors['unit_bldg']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>House/Lot & Blk. No</p>
                    <input type="text" name="house_lot" value="<?php echo htmlspecialchars($house_lot); ?>" >
                    <?php if (isset($errors['house_lot'])): ?>
                        <span class="error"><?php echo $errors['house_lot']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Street Name</p>
                    <input type="text" name="street" value="<?php echo htmlspecialchars($street); ?>" >
                    <?php if (isset($errors['street'])): ?>
                        <span class="error"><?php echo $errors['street']; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Subdivision</p>
                    <input type="text" name="subdivision" value="<?php echo htmlspecialchars($subdivision); ?>" >
                    <?php if (isset($errors['subdivision'])): ?>
                        <span class="error"><?php echo $errors['subdivision']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Barangay/District/Locality</p>
                    <input type="text" name="barangay" value="<?php echo htmlspecialchars($barangay); ?>" >
                    <?php if (isset($errors['barangay'])): ?>
                        <span class="error"><?php echo $errors['barangay']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>City/Municipality</p>
                    <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" >
                    <?php if (isset($errors['city'])): ?>
                        <span class="error"><?php echo $errors['city']; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Province</p>
                    <input type="text" name="province" value="<?php echo htmlspecialchars($province); ?>" >
                    <?php if (isset($errors['province'])): ?>
                        <span class="error"><?php echo $errors['province']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Country</p>
                    <select name="country" >
                        <?php echo $countryOpt; ?>
                    </select>
                    <?php if (isset($errors['country'])): ?>
                        <span class="error"><?php echo $errors['country']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Zip Code</p>
                    <input type="text" name="zip_code" value="<?php echo htmlspecialchars($zip_code); ?>" >
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
                    <input type="text" name="home_unit_bldg" value="<?php echo htmlspecialchars($home_unit_bldg); ?>" >
                    <?php if (isset($errors['home_unit_bldg'])): ?>
                        <span class="error"><?php echo $errors['home_unit_bldg']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>House/Lot & Blk. No</p>
                    <input type="text" name="home_house_lot" value="<?php echo htmlspecialchars($home_house_lot); ?>" >
                    <?php if (isset($errors['home_house_lot'])): ?>
                        <span class="error"><?php echo $errors['home_house_lot']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Street Name</p>
                    <input type="text" name="home_street" value="<?php echo htmlspecialchars($home_street); ?>" >
                    <?php if (isset($errors['home_street'])): ?>
                        <span class="error"><?php echo $errors['home_street']; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Subdivision</p>
                    <input type="text" name="home_subdivision" value="<?php echo htmlspecialchars($home_subdivision); ?>" >
                    <?php if (isset($errors['home_subdivision'])): ?>
                        <span class="error"><?php echo $errors['home_subdivision']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Barangay/District/Locality</p>
                    <input type="text" name="home_barangay" value="<?php echo htmlspecialchars($home_barangay); ?>" >
                    <?php if (isset($errors['home_barangay'])): ?>
                        <span class="error"><?php echo $errors['home_barangay']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>City/Municipality</p>
                    <input type="text" name="home_city" value="<?php echo htmlspecialchars($home_city); ?>" >
                    <?php if (isset($errors['home_city'])): ?>
                        <span class="error"><?php echo $errors['home_city']; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input-box">
                    <p>Province</p>
                    <input type="text" name="home_province" value="<?php echo htmlspecialchars($home_province); ?>" >
                    <?php if (isset($errors['home_province'])): ?>
                        <span class="error"><?php echo $errors['home_province']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Country</p>
                    <select name="home_country" >
                        <?php echo $countryOpt; ?>
                    </select>
                    <?php if (isset($errors['home_country'])): ?>
                        <span class="error"><?php echo $errors['home_country']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-box">
                    <p>Zip Code</p>
                    <input type="text" name="home_zip_code" value="<?php echo htmlspecialchars($home_zip_code); ?>" >
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
        <input type="text" name="mobile_no" value="<?php echo htmlspecialchars($mobile_no); ?>" >
        <?php if (isset($errors['mobile_no'])): ?>
            <span class="error"><?php echo $errors['mobile_no']; ?></span>
        <?php endif; ?>
    </div>
    <div class="input-box">
        <p>Email Address</p>
        <input type="text" name="email_address" value="<?php echo htmlspecialchars($email_address); ?>" >
        <?php if (isset($errors['email_address'])): ?>
            <span class="error"><?php echo $errors['email_address']; ?></span>
        <?php endif; ?>
    </div>
    <div class="input-box">
        <p>Telephone Number</p>
        <input type="text" name="telephone_no" value="<?php echo htmlspecialchars($telephone_no); ?>" >
        <?php if (isset($errors['telephone_no'])): ?>
            <span class="error"><?php echo $errors['telephone_no']; ?></span>
        <?php endif; ?>
    </div>
</div>

            <h2>Father's Name</h2>
            <div class="input-container">
                <div class="input-box">
                    <p>Last Name</p>
                    <input type="text" name="father_last_name" value="<?php echo htmlspecialchars($father_last_name); ?>" >
                    <?php if (isset($errors['father_last_name'])) echo '<p class="error">' . $errors['father_last_name'] . '</p>'; ?>
                </div>
                <div class="input-box">
                    <p>First Name</p>
                    <input type="text" name="father_first_name" value="<?php echo htmlspecialchars($father_first_name); ?>" >
                    <?php if (isset($errors['father_first_name'])) echo '<p class="error">' . $errors['father_first_name'] . '</p>'; ?>
                </div>
                <div class="input-box">
                    <p>Middle Initial</p>
                    <input type="text" name="father_middle_initial" value="<?php echo htmlspecialchars($father_middle_initial); ?>">
                    <?php if (isset($errors['father_middle_initial'])) echo '<p class="error">' . $errors['father_middle_initial'] . '</p>'; ?>
                </div>
            </div>

            <h2>Mother's Name</h2>
            <div class="input-container">
                <div class="input-box">
                    <p>Last Name</p>
                    <input type="text" name="mother_last_name" value="<?php echo htmlspecialchars($mother_last_name); ?>" >
                    <?php if (isset($errors['mother_last_name'])) echo '<p class="error">' . $errors['mother_last_name'] . '</p>'; ?>
                </div>
                <div class="input-box">
                    <p>First Name</p>
                    <input type="text" name="mother_first_name" value="<?php echo htmlspecialchars($mother_first_name); ?>" >
                    <?php if (isset($errors['mother_first_name'])) echo '<p class="error">' . $errors['mother_first_name'] . '</p>'; ?>
                </div>
                <div class="input-box">
                    <p>Middle Initial</p>
                    <input type="text" name="mother_middle_initial" value="<?php echo htmlspecialchars($mother_middle_initial); ?>">
                    <?php if (isset($errors['mother_middle_initial'])) echo '<p class="error">' . $errors['mother_middle_initial'] . '</p>'; ?>
                </div>
            </div>

            <button id="next-button" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>