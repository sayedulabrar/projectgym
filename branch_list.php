<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$nullName = false;
$insert = false;
$samename = false;

$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $br_rent = $_POST['rent'];
    $reg_fee = $_POST['reg'];
    if ($name == NULL) {
      $nullName = true;
    } else {
      $sql = "select * from branch where br_name = '$name'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if ($row) {
        $samename = true;
      } else {
        $sql = "insert into branch (br_name, br_revenue, br_expenditure, br_rent, reg_fee) values('$name', 0, 0, $br_rent, $reg_fee)";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $insert = true;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Branch List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="      plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="      plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="      dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="      dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fitness Maina</span>
      </a>
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto navbar-right-top">
            <li class="nav-item">
              <button onclick="window.location.href=' index.php'" type="button" class="btn btn-secondary">Logout</button>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="      dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="admin_profile.php" class="d-block"><?php echo $_SESSION['uname'] ?></a>
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
                  <a href="admin_db.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">

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
                  <a href="   pages/mailbox/mailbox.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="   pages/mailbox/compose.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Pages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="admin_profile.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="add_employee.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Add Employee</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                <a href="   examples/Branch.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="   examples/Search-Manager.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search Manager</p>
                </a>
              </li>
                -->



              </ul>
            </li>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <!-- <div class="content-wrapper" style="margin-top: 0;"> -->
    <!-- Content Header (Page header) -->














    <!-- Main content -->
    <div class="content-wrapper">
      <section class="content" style="margin-bottom:50px ;">
        <?php
        if ($nullName) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Branch name cannot be empty
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
        }
        if ($insert) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Successfully Created
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
        }
        if ($samename) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              A branch has been already created using this name
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
        }
        ?>
        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12">
              <h2 style="margin-left: 25px;">Branch Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <button type="button" class="insert btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Add New</button>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Create a New Branch</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="branch_list.php" method="POST">
                        <div class="modal-body">

                          <input type="hidden" name="snoEdit" id="snoEdit">
                          <div class="row">
                            <div class="form-group col-lg-12 col-12">
                              <label for="name">Branch Name</label>
                              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                            </div>

                          </div>
                          <div class="row">
                            <div class="form-group col-lg-12 col-12">
                              <label for="rent">Branch Property Rent</label>
                              <input type="text" class="form-control" id="rent" name="rent" aria-describedby="emailHelp">
                            </div>

                          </div>

                          <div class="row">
                            <div class="form-group col-lg-12 col-12">
                              <label for="reg">Registration Fee</label>
                              <input type="text" class="form-control" id="reg" name="reg" aria-describedby="emailHelp">
                            </div>

                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Create Branch</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card-body" style="margin-top:1%">


          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th>Branch Name</th>
                <th>Total Ravenue</th>

                <th>Total Cost</th>
                <th>Total Profit</th>
                <th>Property Rent</th>
              </tr>
            </thead>

            <tbody>
              <?php

              $sql = "Select * FROM Branch";
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);

              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo
                "
          <tr >
          
          
          <td > <strong><a href=";
                $br_name = $row['BR_NAME'];
                $sql = "select * from users where br_name = '$br_name'";
                $stid1 = oci_parse($conn, $sql);
                $r = oci_execute($stid1);
                $row1 = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
                if ($row1 == NULL) {
                  echo "#";
                } else {
                  echo "manager_db.php?un=" . $row1['USERNAME'];
                }


                echo ">" . $row['BR_NAME'] . "</a></strong></td>

            <td ><strong>";
                $sql = 'select br_name, inc_amount, CURRENT_TIMESTAMP-inc_dateandtime "differ" from income';
                $stid2 = oci_parse($conn, $sql);
                $r = oci_execute($stid2);
                $ans = 0;
                while ($row2 = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS)) {

                  $array = explode(" ", $row2["differ"]);
                  $diff = $array[0];
                  $num = (int)$diff;

                  if ($num <= 30 && $row2['BR_NAME'] == $row['BR_NAME']) {
                    $ans = $ans +  $row2["INC_AMOUNT"];
                  }
                }
                echo $ans;
                $branchRevenue = $ans;
                // $row['BR_REVENUE'];  
                echo "</strong></td>
            <td ><strong>";
                $sql = 'select br_name, amount, CURRENT_TIMESTAMP-exp_dateandtime "differ" from expenditure';
                $stid2 = oci_parse($conn, $sql);
                $r = oci_execute($stid2);
                $thisMonth = 0;
                $prevMonth = 0;
                while ($row2 = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS)) {
                  $array = explode(" ", $row2["differ"]);
                  $diff = $array[0];
                  $num = (int)$diff;
                  if ($num <= 30 && $row2['BR_NAME'] == $row['BR_NAME']) {
                    $thisMonth = $thisMonth +  $row2["AMOUNT"];
                  } else if ($num <= 60) {
                    $prevMonth = $prevMonth + $row2["AMOUNT"];
                  }
                }
                echo $thisMonth;
                $branchExpenditure = $thisMonth;
                echo  "</strong></td>
            <td ><strong>";
                echo $branchRevenue - $branchExpenditure;
                echo  "</strong></td>
            <td ><strong>" . $row['BR_RENT'] .
                  "</strong></td>
            
            
          </tr> 
          ";
              }

              ?>










            </tbody>
          </table>
          <!-- /.table -->
        </div>




      </section>











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
  <script src="      plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="      plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="      dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="      dist/js/demo.js"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <!-- Page specific script -->

</body>

</html>