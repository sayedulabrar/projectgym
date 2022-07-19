<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
    or die(oci_error());

  if (!$conn) 
  {
      echo "Sorry";
  }
  else
  {
    $sql = "Select * from users where username='$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $rec = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add to Maintenance</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>
  <body  class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img  src="dist/img/AdminLTELogo.png"  alt="AdminLTE Logo"  class="brand-image img-circle elevation-3"  style="opacity: 0.8">
          <span class="brand-text font-weight-light">Fitness Mania</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img  src="dist/img/user2-160x160.jpg"  class="img-circle elevation-2"  alt="User Image">
            </div>
            <div class="info">
            <a href="employee_profile.php?un_=receptionist" class="d-block">
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
                  <p>Dashboard<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="receptionist.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Receptionist</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item"></li>

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
                    <a href="mailbox/mailbox.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inbox</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="mailbox/compose.html" class="nav-link">
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
                    UserPages
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="examples/profilev2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Profile</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="examples/package.html" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Package</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="examples/Search-Trainer.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Search Trainer</p>
                    </a>
                  </li>
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
                <h1>Add Equipment to Maintenance</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Maintenance</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="d-flex justify-content-around">
            <div class="card card-solid col-12 col-md-6 align-items-stretch flex-column" style="float: left; margin-left: 10px; margin-right: 12px;">
              <form style="padding-bottom: 10px;">
                <div class="form-group">
                  <label for="exampleInputPackageId" style="padding-top: 10px;">Equipment ID</label>
                  <input type="text" class="form-control" id="package_id" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageName">Equipment Name</label>
                  <input type="text" class="form-control" id="package_name" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageCharge">Repair Cost (In Taka)</label>
                  <input type="text" class="form-control" id="package_charge" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageType">Maintenance Date</label>
                  <input type="date" class="form-control" id="package_type" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageDuration">Repairer Company</label>
                  <input type="text" class="form-control" id="package_duration" value="">
                </div>
              </form>
            </div>

            <div class="card card-solid col-12 col-md-6 align-items-stretch flex-column">
              <form style="padding-bottom: 10px;">
                <div class="form-group">
                  <label for="exampleInputPackageId" style="padding-top: 10px;">Name of Repairer</label>
               
                  <input type="text" class="form-control" id="user_name" value="">
                    
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageName">Phone No.</label>
                  <input type="text" class="form-control" id="gender" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageCharge">Expected Delivery Date</label>
                  <input type="Date" class="form-control" id="branch_name" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPackageDuration">Branch</label>
                  <input type="email" class="form-control" id="email" value="">
                </div>
                <!-- <div class="form-group">
                  <label for="exampleInputPackageType">Mobile Number</label>
                  <input
                    type="text"
                    class="form-control"
                    id="mobile_number"
                    value=""
                  />
                </div> -->
              </form>
            </div>
          </div>

          <!-- <div class="form-check col-12  col-md-4 align-items-stretch flex-column">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->

          <div class="col-md-9 text-center">
            <a href="#" type="submit" class="btn btn-success">Confirm</a>
          </div>

          <!-- /.card -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 3.2.0-rc</div>
        <strong>Copyright &copy; 2022 <a href="#">Gym Management System</a></strong>
        All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>
  </body>
</html>
