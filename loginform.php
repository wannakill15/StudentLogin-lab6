<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['auth']))
{
    $_SESSION['status'] = "You are already logged In";
    header('Location: index.php"');
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="section">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-5 my-5">
                    <div class="card my-5">
                        <div class="card-header bg-light">
                            <h5>Student Login</5>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['auth_status']))
                                {
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Hey!</strong> <?php echo $_SESSION['auth_status']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php
                                    unset($_SESSION['auth_status']);
                                }
                            ?>
                            <?php
                                //include('message.php');
                            ?>
                            <form action="logincode.php" method="POST">
                                    <div class="form-group">
                                        <label for="student_id">Student ID</label>
                                        <span></span>
                                        <input type="text" name="student_id" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="modal-footer h-100">
                                        <button type="submit" name="login_btn" class="btn btn-success btn-block">Login</button>
                                    </div> 
                            </form>
                            <div class="text-center ">
                                <p>Don't have an account? <a href="signupform.php" class="btn-sm">Sign Up</a></p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    

<?php 
include('includes/script.php'); 
?>

<?php 
include('includes/footer.php'); 
?>