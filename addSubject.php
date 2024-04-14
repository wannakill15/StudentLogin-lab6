<?php
session_start();
include('config/db_conn.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit - Registered User</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
    
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit - Registered User</h3>
                <a href="enrollSubject.php" class="btn btn-danger bt-sm float-right" >BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-md 6">
                    <form action="code.php" method="post">
                        <div class="modal-body">
                            <?php 
                            if(isset($_GET['student_id'])){
                                $student_id = $_GET['student_id'];
                                $query = "SELECT * FROM student_regis WHERE student_id = '$student_id' LIMIT 1";
                                $run_query = mysqli_query($conn, $query);

                                if(mysqli_num_rows($run_query) > 0){
                                    foreach($run_query as $row){
                                        ?>
                                            <input type="hidden" name="id" value="<?php echo $row['student_id'] ?>" >
                                            <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" name="name" value="<?php echo $row['full_name'] ?> " class="form-control" placeholder="Name" >
                                            </div>
                                            <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?> " class="form-control" placeholder="Email" >
                                            </div>
                                            <div class="form-group">
                                            <label for="phone">PhoneNo.</label>
                                            <input type="text" id="phone" name="phone" value="<?php echo $row['phone_number'] ?> "  class="form-control" placeholder="PhoneNo." >
                                            </div>
                                            <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" name="address" value="<?php echo $row['address'] ?> " class="form-control" placeholder="Address" >
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="pass">Password</label>
                                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="confirm_pass">Confirm Password</label>
                                                <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                            </div>
                                        <?php
                                    }
                            }
                            else{
                                echo"<h4>Record Not Found.!</h4>";
                            }
                        }
                            ?>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="addSubject" class="btn btn-info">ADD</button>
                        </div>
                    </form>
                </div>

            </div>
            </div>
        </div>
    </div>
</div>
</section>


</div>

<?php 
include("includes/script.php");
?>

<?php 
include("includes/footer.php");
?>