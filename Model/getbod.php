<?php
function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime();
    return $today->diff($dob)->y; 
}
?>