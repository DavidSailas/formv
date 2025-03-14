<?php

require 'User.php';

class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserById($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM user_table WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function saveUser ($data, $user_id = null) {
        if ($user_id) {
            $sql = "UPDATE user_table SET 
                last_name=?, first_name=?, middle_name=?, dob=?, sex=?, civil_status=?, civil_status_other=?, 
                tax_id=?, nationality=?, religion=?, unit_bldg=?, house_lot=?, street=?, subdivision=?, barangay=?, city=?, 
                province=?, country=?, zip_code=?, mobile_no=?, email_address=?, telephone_no=?, 
                father_last_name=?, father_first_name=?, father_middle_initial=?, mother_last_name=?, 
                mother_first_name=?, mother_middle_initial=?, home_unit_bldg=?, home_house_lot=?, 
                home_street=?, home_subdivision=?, home_barangay=?, home_city=?, home_province=?, 
                home_country=?, home_zip_code=? 
                WHERE user_id=?";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssssi", 
                $data['last_name'], $data['first_name'], $data['middle_name'], $data['dob'], $data['sex'], $data['civil_status'], 
                $data['civil_status_other'], $data['tax_id'], $data['nationality'], $data['religion'], $data['unit_bldg'], 
                $data['house_lot'], $data['street'], $data['subdivision'], $data['barangay'], $data['city'], $data['province'], 
                $data['country'], $data['zip_code'], $data['mobile_no'], $data['email_address'], $data['telephone_no'], 
                $data['father_last_name'], $data['father_first_name'], $data['father_middle_initial'], $data['mother_last_name'], 
                $data['mother_first_name'], $data['mother_middle_initial'], $data['home_unit_bldg'], 
                $data['home_house_lot'], $data['home_street'], $data['home_subdivision'], $data['home_barangay'], 
                $data['home_city'], $data['home_province'], $data['home_country'], $data['home_zip_code'], $user_id
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
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssssssssssssssssssssssssssss", 
                $data['last_name'], $data['first_name'], $data['middle_name'], $data['dob'], $data['sex'], $data['civil_status'], 
                $data['civil_status_other'], $data['tax_id'], $data['nationality'], $data['religion'], $data['unit_bldg'], 
                $data['house_lot'], $data['street'], $data['subdivision'], $data['barangay'], $data['city'], $data['province'], 
                $data['country'], $data['zip_code'], $data['mobile_no'], $data['email_address'], $data['telephone_no'], 
                $data['father_last_name'], $data['father_first_name'], $data['father_middle_initial'], $data['mother_last_name'], 
                $data['mother_first_name'], $data['mother_middle_initial'], $data['home_unit_bldg'], 
                $data['home_house_lot'], $data['home_street'], $data['home_subdivision'], $data['home_barangay'], 
                $data['home_city'], $data['home_province'], $data['home_country'], $data['home_zip_code']
            );
        }
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function isEmailDuplicate($email, $user_id = null) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM user_table WHERE email_address = ? AND user_id != ?");
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }
}
?>