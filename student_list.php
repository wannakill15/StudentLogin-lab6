<?php
session_start();
include('config/db_conn.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Modal -->
<div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="Name" >
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" >
        </div>
        <div class="form-group">
          <label for="phone">PhoneNo.</label>
          <input type="text" id="phone" name="phone" class="form-control" placeholder="PhoneNo." >
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" class="form-control" placeholder="Address" >
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addUser" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="delete_id" class="delete_user_id" >
        <p>
          Are you sure. you want to delete this data?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="deleteUserbtn" class="btn btn-primary">Yes, Delete.!</button>
      </div>
      </form>
    </div>
  </div>
</div>

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
              <li class="breadcrumb-item active">Registered User</li>
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
                <h3 class="card-title">Registered User</h3>
                <a href="#" data-toggle="modal" data-target="#usersModal" class="btn btn-primary bt-sm float-right" >Add User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $query = "SELECT * FROM student_list";
                      $run_query = mysqli_query($conn, $query);
                      if(mysqli_num_rows  ($run_query) > 0) {
                        foreach($run_query as $row) {
                          ?>
                          <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['full_name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['course'] ?></td>
                        </tr> 
                        <?php
                        }
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

<script>
  $(document).ready(function () {
    $('.deletebtn').click(function (e){
      e.preventDefault()

      var user_id = $(this).val();
      //console.log(user_id);
      $('.delete_user_id').val(user_id);
      $('#DeleteModal').modal('show');

    });
  });
</script>

<?php 
include("includes/footer.php");
?>