<?php
session_start();

// Include file for database connection
include('config/db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the verification code and email from the form
    $Token = $_POST['Token'];
    $email = $_POST['email'];

    // SQL query to check if the verification code matches the one stored in the database
    $sql = "SELECT * FROM student_regis WHERE email='$email' AND Token='$Token' ";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Error handling for SQL query
        $_SESSION['status'] = "Database error occurred. Please try again later.";
        header("Location: VerifyForm.php");
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        // Update the user's record to mark them as verified
        $update_sql = "UPDATE student_regis SET Status='Verified' WHERE Email='$email' AND Token='$Token'";
        if (mysqli_query($conn, $update_sql)) {
            // Redirect to the login form with a success message
            $_SESSION['status'] = "Email successfully verified. You can now log in.";
            header('Location: loginform.php');
            exit();
        } else {
            // Error updating record
            $_SESSION['status'] = "Verification failed. Please try again.";
            header('Location: VerifyForm.php?message=Error updating record');
            exit();
        }
    } else {
        // Invalid verification code
        $_SESSION['status'] = "Invalid verification code. Please try again.";
        header('Location: VerifyForm.php?message=Invalid verification code');
        exit();
    }
} else {
    // Display an error message indicating failed verification
    $_SESSION['status'] = "Invalid request. Please try again.";
    header('Location: VerifyForm.php?message=Invalid request');
    exit();
}

mysqli_close($conn);
?>
