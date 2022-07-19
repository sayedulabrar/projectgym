<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output et
$ageActive = false;
$salaryActive = false;
$uname = $_SESSION['uname'];

$_SESSION['designation'] = 'Manager';
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $sql = "DELETE FROM USERS WHERE USERNAME = '$username'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
    }

    if (isset($_POST['uname']) && isset($_POST['emp_id'])) {
      $br_name = $_POST['uname'];
      $salary = $_POST['salary'];
      $emp_id = $_POST['emp_id'];
      $designation = $_POST['designation'];
      $shift = $_POST['shift'];
      if($shift == 'Morning') {
        $shift = 1;
      }
      else {
        $shift = 2;
      }
      $sql = "UPDATE EMPLOYEE SET SALARY = $salary, SHIFT = $shift, DESIGNATION = '$designation'  where EMP_ID = $emp_id";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $sql = "SELECT * FROM EMPLOYEE WHERE EMP_ID = $emp_id";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      $username = $row['USERNAME'];
      $sql = "UPDATE USERS SET BR_NAME = '$br_name' where USERNAME = '$username'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
    }
    if(isset($_POST['s_a']) && isset($_POST['f_a'])) {
      $s_a = $_POST['s_a'];
      $f_a = $_POST['f_a'];
      $ageActive = true;
    }
    if(isset($_POST['s_s']) && isset($_POST['f_s'])) {
      $s_s = $_POST['s_s'];
      $f_s = $_POST['f_s'];
      $salaryActive = true;
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>managers List</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-lg navbar-dark fixed-top">
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



    <!-- /.navbar -->

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
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="admin_profile.php" class="d-block"><?php echo $uname; ?>
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
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Mailbox
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/mailbox/mailbox.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/compose.php" class="nav-link">
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
                  <a href="employee_profile2.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="pages/examples/userreg.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Member Add</p>
                  </a>


                <li class="nav-item">
                  <a href="pages/examples/Search-Manager.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Search Manager</p>
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
    <div class="content-wrapper">
      <section class="content" style="margin-bottom:50px ;">
        <!-- Insert Modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to remove him?</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
              </div>
              <div class="modal-body">
                <form action="manager_list.php" method="POST">
                  <input type="hidden" name="username" id="username">
                  <div class="modal-body" style="float: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='manager_list.php'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Comfirm</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <!-- /Insert Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Info</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
              </div>
              <div class="modal-body">
                <form action="manager_list.php" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="emp_id" id="emp_id">

                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label for="uname">Branch Name</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group col-lg-6 col-12">
                        <label for="designation">Designation</label>
                        <!-- <input type="text" class="form-control" id="designation" name="designation" aria-describedby="emailHelp"> -->
                        <select name="designation" id="designation" class="form-select" aria-label="Default select example" style="width: 208px; height: 37px;">
                          <option selected value="Manager">Manager</option>
                          <option selected value="Trainer">Trainer</option>
                          <option selected value="Receptionist">Receptionist</option>


                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control" id="salary" name="salary" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group col-lg-6 col-12">
                        <label for="shift">Shift</label>
                        
                        <select name="shift" id="shift" class="form-select" aria-label="Default select example" style="width: 208px; height: 37px;">
                          <option selected value="Morning">Morning</option>
                          <option value="Evening">Evening</option>
                          


                        </select>
                      </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='manager_list.php'">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <div class="container-fluid">
          <!-- <form action="Manager-results.html"> -->
          <div class="row">
              
            <div class="col-md-12">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Search Using</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                              title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="bg-light clearfix">
                    
                    <br>
                    <div class="container" >
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <h5 style="text-align: center;">Salary</h5>
                  <br>
                  <form action="manager_list.php" method = "POST">
                    <div class="row">
                      <div class="form-group col-lg-4 col-12">
                        <input type="text" placeholder="From" class="form-control" id="s_s" name="s_s" aria-describedby="emailHelp">  
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <input type="text" placeholder="To" class="form-control" id="f_s" name="f_s">
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <button type="submit" class="btn btn-secondary">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="form-group col-lg-6 col-12">
                  <h5 style="text-align: center;">Age</h5>
                  <br>
                  <form action="manager_list.php" method = "POST">
                    <div class="row">
                      <div class="form-group col-lg-4 col-12">
                        <input type="text" placeholder="From" class="form-control" id="s_a" name="s_a" aria-describedby="emailHelp">  
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <input type="text" placeholder="To" class="form-control" id="f_a" name="f_a">
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <button type="submit" class="btn btn-secondary">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
                  </div>

                </div>
                      <!-- /.card-body -->
              </div>
                  <!-- /.card -->
            </div>

          </div>
        </div>


        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12">
              <h2 style="margin-left: 25px;">Manager Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <button type="button" class="insert btn btn-success float-right" data-toggle="modal" data-target="#exampleModal" onclick="window.location.href='add_employee.php'">Add New</button>


            </div>
          </div>
        </div>

        <div class="card-body" style="margin-top:1%">

          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th scope="col">Employee ID</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Salary</th>
                <th scope="col">Shift</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
              if($ageActive) {
                $sql = "select EMP_ID, NAME, GENDER, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where designation = 'Manager' and floor((SYSDATE - DOB)/365) >= $s_a and floor((SYSDATE - DOB)/365) <= $f_a";
                
              }
              elseif($salaryActive) {
                $sql = "select EMP_ID, NAME, GENDER, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where designation = 'Manager' and salary >=$s_s and salary <= $f_s";
              }
              else {
              $sql = "select EMP_ID, NAME, GENDER, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where designation = 'Manager'";
              }
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $un = $row['USERNAME'];
                echo "
              <tr id='Manager'>
              <th scope='row'>" . $row['EMP_ID'] . "</th>
              <td><a href='employee_profile.php?un =" . $un . " '>" . $row["NAME"] . "</a></td>
              <td>" . $row["GENDER"] . "</td>
              <td>" . floor($row["SYSDATE-DOB"] / 365) . "</td>
              <td>" . $row["SALARY"] . "</td>
              <td>";
              if($row['SHIFT'] == 1) {
                echo "Morning";
              }
              else {
                echo "Evening";
              }
              
               echo "</td>";
              echo "<td> <button class='delete btn btn-sm btn-danger' id=" . $row['USERNAME'] . ">Remove</button> <button class='update btn btn-sm btn-primary' id=" . $row['BR_NAME'] . ">Edit</button> </td>
              </tr>
              ";
                // ECHO var_dump($row);
              }


              ?>

            </tbody>
          </table>



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

    <!-- Main Footer -->
    <footer class="main-footer dark-mode" style="color: #869099">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("delete ", );
        tr = e.target.parentNode.parentNode;
        username.value = e.target.id;
        console.log(username);
        $('#exampleModal').modal('toggle');
      })
    })
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("update ", );
        tr = e.target.parentNode.parentNode;
        uname.value = e.target.id;
        designation.value = tr.id;
        shift.value = tr.getElementsByTagName("td")[4].innerText;
        salary.value = tr.getElementsByTagName("td")[3].innerText;
        emp_id.value = tr.getElementsByTagName("th")[0].innerText;
        console.log(emp_id);
        $('#exampleModal1').modal('toggle');
      })
    })
  </script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>