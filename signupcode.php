<?php
session_start();
include('config/db_conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['signup_btn'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $full_name = validate($_POST['full_name']);
    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $Status = 'Not Verified'; // Set default value
    $Active = 'Not Active'; // Set default value

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signupform.php?error=Invalid email format");
        exit();
    }

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM student_regis WHERE email='$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    if (mysqli_num_rows($result_check_email) > 0) {
        header("Location: signupform.php?error=Email already exists");
        exit();
    }

    // Generate a unique verification token
    $Token = mt_rand(1000, 9999);

    // Generate a unique id for students containing only integers
    do {
        $student_id = mt_rand(1000, 9999); // Generates a random 4-digit integer
        // Check if the token already exists in the database
        $sql_check_token = "SELECT * FROM student_regis WHERE Token='$Token'";
        $result_check_token = mysqli_query($conn, $sql_check_token);
    } while (mysqli_num_rows($result_check_token) > 0);

    // Insert user data into the database
    $insert_query = "INSERT INTO student_regis (student_id, email, password, full_name, first_name, last_name, Status, Active, Token)
    VALUES ('$student_id', '$email', '$password', '$full_name', '$first_name', '$last_name', '$Status', '$Active', '$Token')";
    $insert_query_run = mysqli_query($conn, $insert_query);

    if ($insert_query_run) {
        // Send verification email
        $verification_subject = "Email Verification";
        $verification_message = "Hello, $full_name. Your verification code is: $Token";
    
        // Create a PHPMailer instance for verification email
        $verification_mail = new PHPMailer(true);
    
        try {
            // SMTP configuration for verification email
            $verification_mail->isSMTP();
            $verification_mail->Host = 'smtp.gmail.com';
            $verification_mail->SMTPAuth = true;
            $verification_mail->Username = 'cocnambawan@gmail.com'; // Your gmail
            $verification_mail->Password = 'bkvm sirf keww nswm'; // Your gmail app password
            $verification_mail->SMTPSecure = 'ssl';
            $verification_mail->Port = 465;
    
            // Sender and recipient for verification email
            $verification_mail->setFrom('cocnambawan@gmail.com', 'Email Verification');
            $verification_mail->addAddress($email);
    
            // Email content for verification email
            $verification_mail->isHTML(true);
            $verification_mail->Subject = $verification_subject;
            $verification_mail->Body = $verification_message;
    
            // Send verification email
            $verification_mail->send();
    
            // Send student ID email
            $student_id_subject = "Student ID";
            $student_id_message = "Hello, $full_name. Your student ID is: $student_id";
    
            // Create a PHPMailer instance for student ID email
            $student_id_mail = new PHPMailer(true);
    
            // SMTP configuration for student ID email (same as verification email)
            $student_id_mail->isSMTP();
            $student_id_mail->Host = 'smtp.gmail.com';
            $student_id_mail->SMTPAuth = true;
            $student_id_mail->Username = 'cocnambawan@gmail.com'; // Your gmail
            $student_id_mail->Password = 'bkvm sirf keww nswm'; // Your gmail app password
            $student_id_mail->SMTPSecure = 'ssl';
            $student_id_mail->Port = 465;
    
            // Sender and recipient for student ID email
            $student_id_mail->setFrom('cocnambawan@gmail.com', 'Student ID');
            $student_id_mail->addAddress($email);
    
            // Email content for student ID email
            $student_id_mail->isHTML(true);
            $student_id_mail->Subject = $student_id_subject;
            $student_id_mail->Body = $student_id_message;
    
            // Send student ID email
            $student_id_mail->send();
    
            // Redirect with a success message
            $_SESSION['status'] = "Account created successfully. Please check your email for verification and student ID.";
            header('Location: verifyForm.php');
            exit();
        } catch (Exception $e) {
            // Display an error message if any of the emails could not be sent
            $_SESSION['status'] = "Email(s) could not be sent. Please try again later.";
            header("Location: signupform.php");
            exit();
        }
    } else {
        // Display an error message if the query fails
        $_SESSION['status'] = "Failed to create account. Please try again.";
        header('Location: signupform.php');
        exit();
    }
}
?>
