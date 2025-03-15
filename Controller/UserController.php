<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/formv/Model/UserModel.php';

class UserController {
    private $model;

    public function __construct($conn) {
        $this->model = new UserModel($conn);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleFormSubmission();
        } elseif (isset($_GET['edit'])) {
            $this->handleEditRequest();
        }
    }

    private function handleFormSubmission() {
        // Start the session only once
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = $this->sanitizeInput($_POST);
        $errors = $this->validateInput($data);

        if (empty($errors)) {
            $user_id = isset($_GET['edit']) ? $_GET['edit'] : null;

            // Check for duplicate email before saving
            if ($this->model->isEmailDuplicate($data['email_address'], $user_id)) {
                $errors['email_address'] = "*Email address already exists.";
                $_SESSION['errors'] = $errors;
                $_SESSION['form_data'] = $data;
                header('Location: /formv/View/index.php');
                exit();
            }

            if ($this->model->saveUser ($data, $user_id)) {
                // Store the form data in session for display
                $_SESSION['form_data'] = $data; // Store data to display later
                header('Location: /formv/View/display_data.php');
                exit();
            }  else {
                echo "Error saving user data.";
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $data;
            header('Location: /formv/View/index.php');
            exit();
        }
    }

    private function handleEditRequest() {
        $user_id = $_GET['edit'];
        $user = $this->model->getUserById($user_id);

        if ($user) {
            session_start();
            $_SESSION['form_data'] = $user;
            header('Location: /formv/View/index.php');
            exit();
        } else {
            echo "User  not found.";
        }
    }

    private function sanitizeInput($data) {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }
        return $data;
    }

    private function validateInput($data) {
        $errors = [];

        // Required Field Validations
        $this->validateRequiredField($data['last_name'], 'last_name', $errors);
        $this->validateNoNumbers($data['last_name'], 'last_name', $errors);

        $this->validateRequiredField($data['first_name'], 'first_name', $errors);
        $this->validateNoNumbers($data['first_name'], 'first_name', $errors);

        $this->validateOptionalField($data['middle_name'], 'middle_name', $errors);
        $this->validateNoNumbers($data['middle_name'], 'middle_name', $errors);

        $this->validateAge($data['dob'], $errors);

        $this->validateRequiredField($data['sex'], 'sex', $errors);

        $this->validateRequiredField($data['civil_status'], 'civil_status', $errors);
        if ($data['civil_status'] === 'Others') {
            $this->validateRequiredField($data['civil_status_other'], 'civil_status_other', $errors);
        }

        $this->validateRequiredField($data['tax_id'], 'tax_id', $errors);
        $this->validateNumericField($data['tax_id'], 'tax_id', $errors);

        $this->validateRequiredField($data['nationality'], 'nationality', $errors);

        $this->validateOptionalField($data['religion'], 'religion', $errors);

        // Place of Birth Validations
        $this->validateRequiredField($data['unit_bldg'], 'unit_bldg', $errors);
        $this->validateRequiredField($data['house_lot'], 'house_lot', $errors);
        $this->validateRequiredField($data['street'], 'street', $errors);
        $this->validateOptionalField($data['subdivision'], 'subdivision', $errors);
        $this->validateOptionalField($data['barangay'], 'barangay', $errors);
        $this->validateOptionalField($data['city'], 'city', $errors);
        $this->validateOptionalField($data['province'], 'province', $errors);
        $this->validateOptionalField($data['country'], 'country', $errors);
        $this->validateNumericField($data['zip_code'], 'zip_code', $errors);

        // Home Address Validations
        $this->validateRequiredField($data['home_unit_bldg'], 'home_unit_bldg', $errors);
        $this->validateOptionalField($data['home_unit_bldg'], 'home_unit_bldg', $errors);

        $this->validateRequiredField($data['home_house_lot'], 'home_house_lot', $errors);
        $this->validateRequiredField($data['home_house_lot'], 'home_house_lot', $errors);

        $this->validateRequiredField($data['home_street'], 'home_street', $errors);
        $this->validateRequiredField($data['home_street'], 'home_street', $errors);

        $this->validateRequiredField($data['home_subdivision'], 'home_subdivision', $errors);
        $this->validateOptionalField($data['home_subdivision'], 'home_subdivision', $errors);  

        $this->validateRequiredField($data['home_barangay'], 'home_barangay', $errors);
        $this->validateOptionalField($data['home_barangay'], 'home_barangay', $errors);

        $this->validateRequiredField($data['home_city'], 'home_city', $errors);
        $this->validateOptionalField($data['home_city'], 'home_city', $errors);

        $this->validateRequiredField($data['home_province'], 'home_province', $errors);
        $this->validateOptionalField($data['home_province'], 'home_province', $errors);

        $this->validateRequiredField($data['home_country'], 'home_country', $errors);
        $this->validateOptionalField($data['home_country'], 'home_country', $errors);

        $this->validateRequiredField($data['home_zip_code'], 'home_zip_code', $errors);
        $this->validateNumericField($data['home_zip_code'], 'home_zip_code', $errors);

        // Contact Info Validations
        $this->validateRequiredField($data['mobile_no'], 'mobile_no', $errors);
        $this->validateNumericField($data['mobile_no'], 'mobile_no', $errors);

        $this->validateEmail($data['email_address'], $errors);

        $this->validateOptionalField($data['telephone_no'], 'telephone_no', $errors);
        $this->validateNumericField($data['telephone_no'], 'telephone_no', $errors);

        // Parent's Name Validations
        $this->validateOptionalField($data['father_last_name'], 'father_last_name', $errors);
        $this->validateNoNumbers($data['father_last_name'], 'father_last_name', $errors);

        $this->validateOptionalField($data['father_first_name'], 'father_first_name', $errors);
        $this->validateNoNumbers($data['father_first_name'], 'father_first_name', $errors);

        $this->validateOptionalField($data['father_middle_initial'], 'father_middle_initial', $errors);
        $this->validateNoNumbers($data['father_middle_initial'], 'father_middle_initial', $errors);

        $this->validateOptionalField($data['mother_last_name'], 'mother_last_name', $errors);
        $this->validateNoNumbers($data['mother_last_name'], 'mother_last_name', $errors);

        $this->validateOptionalField($data['mother_first_name'], 'mother_first_name', $errors);
        $this->validateNoNumbers($data['mother_first_name'], 'mother_first_name', $errors);

        $this->validateOptionalField($data['mother_middle_initial'], 'mother_middle_initial', $errors);
        $this->validateNoNumbers($data['mother_middle_initial'], 'mother_middle_initial', $errors);

        return $errors;
    }

    private function validateRequiredField($field, $fieldName, &$errors) {
        if (empty(trim($field))) {
            $errors[$fieldName] = "*Field is required.";
        }
    }

    private function validateOptionalField($field, $fieldName, &$errors) {
        if (!empty($field) && ctype_space($field)) {
            $errors[$fieldName] = "*Field cannot contain only spaces.";
        }
    }

    private function validateNoNumbers($field, $fieldName, &$errors) {
        if (!empty($field) && preg_match('/[0-9]/', $field)) {
            $errors[$fieldName] = "*Must not contain numbers.";
        }
    }

    private function validateNumericField($field, $fieldName, &$errors) {
        if (!empty($field) && !ctype_digit($field)) {
            $errors[$fieldName] = "*Must contain numbers only.";
        }
    }

    private function validateEmail($email, &$errors) {
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email_address'] = "*Invalid email format.";
        }
    }

    private function calculateAge($dob) {
        $dob = new DateTime($dob);
        $today = new DateTime();
        return $today->diff($dob)->y;
    }

    private function validateAge($dob, &$errors) {
        if (empty($dob)) {
            $errors['dob'] = "*Field is required.";
        } elseif ($this->calculateAge($dob) < 18) {
            $errors['dob'] = "*Must be at least 18 years old.";
        }
    }
}
?>