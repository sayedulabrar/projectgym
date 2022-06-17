<?php
  session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
  $uname = $_SESSION['uname'];
  $conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
  if (!$conn) {
    echo "sorry";
  } else {
    $sql = "select *from EMPLOYEE natural join users where username = '$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $userJoinEmployee = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Fitness Mania</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/enan_pinki.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="employee_profile.php" class="d-block">
            <?php
              echo $uname;
            ?>
          </a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="manager_db.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manager</p>
                </a>
              </li>
              
            </ul>
          </li>
         
       
          <li class="nav-item">
            
          </li>
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                 
              <li class="nav-item">
                <a href="employee_profile.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_employee.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_member.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Add Member</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="examples/Branch.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Branch</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="examples/Search-Manager.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search Manager</p>
                </a>
              </li> -->
               
              
              
              
            </ul>
          </li>
         
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-top: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="manager_db.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="roww">
          <div class="col-md-30">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/enan_pinki.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                  <?php
                    echo $userJoinEmployee["USERNAME"];
                  ?>
                </h3>

                <p class="text-muted text-center"></p>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h3 style="text-align: center;"><b>Personal Info</b></h3>
                        <ul class="list-group list-group-unbordered mb-3">                    
                            <li class="list-group-item">
                              <b>Name</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["NAME"];
                              ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Email</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["EMAIL"];
                              ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Gender</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["GENDER"];
                              ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Address</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["ADDRESS"];
                              ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Account Number</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["ACCOUNT_NO"];
                              ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Mobile_No</b> <a class="float-right">
                                <?php
                                  $sql = "select *from user_mobileno where username = '$uname'";
                                  $stid = oci_parse($conn, $sql);
                                  $r = oci_execute($stid);
                                  $num = 0;
                                  while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                    $num = $num + 1;
                                  }
                                  $stid = oci_parse($conn, $sql);
                                  $r = oci_execute($stid);
                                  $n = 0;
                                  while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                    $n = $n+1;
                                    if($n == $num) {
                                      echo $row["MOBILE_NO"];
                                    }
                                    else {
                                      echo $row["MOBILE_NO"]. ', ';
                                    }
                                  }
                                ?>
                              </a>
                            </li>  
                            <li class="list-group-item">
                              <b>Blood Group</b> <a class="float-right">
                              <?php
                                echo $userJoinEmployee["BLOOD_GRP"];
                              ?>
                              </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                      <h3 style="text-align: center;"><b>Gym Related Info</b></h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Branch Name</b> <a class="float-right">
                            <?php
                              echo $userJoinEmployee["BR_NAME"];
                            ?>
                            </a>
                        </li>                    
                          <li class="list-group-item">
                            <b>Employee ID</b> <a class="float-right">
                            <?php
                              echo $userJoinEmployee["EMP_ID"];
                            ?>
                            </a>
                          </li>
                          
                          <li class="list-group-item">
                            <b>Salary</b> <a class="float-right">
                            <?php
                              echo $userJoinEmployee["SALARY"];
                            ?>
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>Shift</b> <a class="float-right">
                              <?php
                                if($userJoinEmployee["SHIFT"] == 1) {
                                 echo "8:00 AM";
                                }
                                else {
                                  echo "8:00 PM";
                                }
                              ?>
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>Rating</b> <a class="float-right">
                            <?php
                              echo $userJoinEmployee["RATING_VALUE"];
                            ?>
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>Designation</b> <a class="float-right">
                            <?php
                              echo $userJoinEmployee["DESIGNATION"];
                            ?>
                            </a>
                          </li> 
                      </ul>
                    </div>
                </div>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <button onclick="window.location.href='trainer_list.html'" type="button" class="btn btn-primary" style="padding-left: 20px; padding-right: 20px;">Back</button>
            </div>
        </div>
      </div> -->
      <div class="card-footer">
        <div class="float-right">
          <a href="profile_edit.html">
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Edit</button></a>
        </div>
        
      </div>
    </section>
    
         <!-- /.content -->
    <div style="margin-bottom:30px ;"></div>
  </div>
  <!-- /.content-wrapper -->
     

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
