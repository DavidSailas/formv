<?php 

class User {
    // User properties
    public $last_name;
    public $first_name;
    public $middle_name;
    public $dob;
    public $sex;
    public $civil_status;
    public $civil_status_other;
    public $tax_id;
    public $nationality;
    public $religion;
    public $unit_bldg;
    public $house_lot;
    public $street;
    public $subdivision;
    public $barangay;
    public $city;
    public $province;
    public $country;
    public $zip_code;
    public $mobile_no;
    public $email_address;
    public $telephone_no;
    public $father_last_name;
    public $father_first_name;
    public $father_middle_initial;
    public $mother_last_name;
    public $mother_first_name;
    public $mother_middle_initial;
    public $home_unit_bldg;
    public $home_house_lot;
    public $home_street;
    public $home_subdivision;
    public $home_barangay;
    public $home_city;
    public $home_province;
    public $home_country;
    public $home_zip_code;

    // Constructor to initialize properties
    public function __construct($data = []) {
        $this->last_name = $data['last_name'] ?? '';
        $this->first_name = $data['first_name'] ?? '';
        $this->middle_name = $data['middle_name'] ?? '';
        $this->dob = $data['dob'] ?? '';
        $this->sex = $data['sex'] ?? '';
        $this->civil_status = $data['civil_status'] ?? '';
        $this->civil_status_other = $data['civil_status_other'] ?? '';
        $this->tax_id = $data['tax_id'] ?? '';
        $this->nationality = $data['nationality'] ?? '';
        $this->religion = $data['religion'] ?? '';
        $this->unit_bldg = $data['unit_bldg'] ?? '';
        $this->house_lot = $data['house_lot'] ?? '';
        $this->street = $data['street'] ?? '';
        $this->subdivision = $data['subdivision'] ?? '';
        $this->barangay = $data['barangay'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->province = $data['province'] ?? '';
        $this->country = $data['country'] ?? '';
        $this->zip_code = $data['zip_code'] ?? '';
        $this->mobile_no = $data['mobile_no'] ?? '';
        $this->email_address = $data['email_address'] ?? '';
        $this->telephone_no = $data['telephone_no'] ?? '';
        $this->father_last_name = $data['father_last_name'] ?? '';
        $this->father_first_name = $data['father_first_name'] ?? '';
        $this->father_middle_initial = $data['father_middle_initial'] ?? '';
        $this->mother_last_name = $data['mother_last_name'] ?? '';
        $this->mother_first_name = $data['mother_first_name'] ?? '';
        $this->mother_middle_initial = $data['mother_middle_initial'] ?? '';
        $this->home_unit_bldg = $data['home_unit_bldg'] ?? '';
        $this->home_house_lot = $data['home_house_lot'] ?? '';
        $this->home_street = $data['home_street'] ?? '';
        $this->home_subdivision = $data['home_subdivision'] ?? '';
        $this->home_barangay = $data['home_barangay'] ?? '';
        $this->home_city = $data['home_city'] ?? '';
        $this->home_province = $data['home_province'] ?? '';
        $this->home_country = $data['home_country'] ?? '';
        $this->home_zip_code = $data['home_zip_code'] ?? '';
    }

    // Method to generate country options
    public static function getCountryOptions($selectedCountry = '') {
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

        $countryOpt = '<option value="">Select</option>';
        foreach ($countries as $country) {
            $countryOpt .= "<option value='$country'" . ($selectedCountry === $country ? ' selected' : '') . ">$country</option>";
        }
        return $countryOpt;
    }
}
?>