<?php

function validate_registration($data) {
    $errors = [
        'first_name_error' => '',
        'last_name_error' => '',
        'email_error' => '',
        'phone_error' => '',
        'address_error' => '',
        'password_error' => '',
        'confirm_password_error' => ''
    ];

    $error_flag = false;

    // Extracting data
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $address = $data['address'];
    $password = $data['password'];
    $confirm_password = $data['confirm_password'];

    // Validate first_name
    if (empty($first_name)) {
        $errors['first_name_error'] = "First name is required";
        $error_flag = true;
    }

    // Validate last_name
    if (empty($last_name)) {
        $errors['last_name_error'] = "Last name is required";
        $error_flag = true;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = "Invalid email format";
        $error_flag = true;
    }

    // Validate phone
    // Define a regex for phone format
    // Optional country code (+ or 00 followe by 1 to 3 digits)
    // Optional space or dash separator
    // Number (7 to 12 digits)
    if (!preg_match("/^(\+|00\d{1,3})?[- ]?\d{7,12}$/", $phone)) {
        $errors['phone_error'] = "Invalid phone number";
        $error_flag = true;
    }

    // Validate password
    if (strlen($password) < 6) {
        $errors['password_error'] = "Password must be at least 6 characters";
        $error_flag = true;
    }

    // Validate confirm_password
    if ($password != $confirm_password) {
        $errors['confirm_password_error'] = "Passwords do not match";
        $error_flag = true;
    }

    // Return errors array and a flag indicating whether there are errors
    return ['errors' => $errors, 'error_flag' => $error_flag];
}

    

?>
