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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Subjects</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php   
            if (isset($_SESSION['status'])) {
              echo "<h4>".$_SESSION['status']."</h4>" ;
              unset($_SESSION['status']);
            }

            ?>
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Subjects</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="info" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Subject Enrolled</th>
                            <th>Add Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $query = "SELECT DISTINCT student_id, full_name, 1 FROM student_regis";
                      $run_query = mysqli_query($conn, $query);
                      if(mysqli_num_rows  ($run_query) > 0) {
                        foreach($run_query as $row) {
                          ?>
                          <tr>
                            <td><?php echo $row['student_id'] ?></td>
                            <td><?php echo $row['full_name'] ?></td>
                            <td><?php echo $row['1'] ?></td>
                            <td>
                              <a href="addSubject.php?student_id= <?php echo $row['student_id'] ?>" class="btn btn-info btn-sm" >Add</a>
                            </td>
                        </tr> 
                        <?php
                        }
                      }else{
                        ?>
                        <tr>
                          <td>Record Not Found</td>
                        </tr>
                        <?php
                      }


                      ?>
                        
                    </tbody>
                </table>
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