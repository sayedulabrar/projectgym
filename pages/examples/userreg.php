<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$link = 'manager_list.php';
$designation = 'Manager';

$conn = oci_connect('Abrar', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
}

?>










<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Registor</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../admin_db.php" class="nav-link">Home</a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item float-right">
          <button type="button" class="btn btn-primary">Logout</button>
        </li>



      </ul>
    </nav>
    <!-- /.navbar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <?php echo $uname ?>
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
                  <a href="../../admin_db.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v2</p>
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
                  <a href="../mailbox/mailbox.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../mailbox/compose.php" class="nav-link">
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
                  <a href="../examples/profilev2.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>





                <li class="nav-item">
                  <a href="../examples/userreg.html" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Member Add</p>
                  </a>

                <li class="nav-item">
                  <a href="../examples/Branch.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Branch</p>
                  </a>
                <li class="nav-item">
                  <a href="../examples/Search-Manager.html" class="nav-link">
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
    <div class="content-wrapper" style="margin-top: 0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1> Manager Add</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"> Manager Add</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content" style="margin-bottom:50px ;">
        <form action="userreg.php" method="POST">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <!-- username and password jokhon ekjon member ke add kora hobe by default dewa hobe or name and password o oita  -->
                  <!-- pore user oita change korte parbe anytime jokhon e o cay from his profile -->
                  <div class="form-group">
                    <label for="name"> Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" id="gender" name="gender" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="branch">Branch Name</label>
                    <input type="text" id="branch" name="branch" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="dob"> Date of Birth (DD-MM-YYYY format)</label>
                    <input type="text" id="dob" id="datepicker" name="dob" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="mobileno">Mobile No</label>
                    <input type="text" id="mobileno" name="mobileno" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="accountno">Account No</label>
                    <input type="text" id="accountno" name="accountno" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" id="salary" name="salary" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="bloodgrp">Blood Group</label>
                    <input type="text" id="bloodgrp" name="bloodgrp" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="education">Education</label>
                    <input type="text" id="education" name="education" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="experience">Experience</label>
                    <input type="text" id="experience" name="experience" class="form-control">
                  </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>


          </div>
          <div class="row">
            <div class="col-12">
              <a href="../../manager_list.php" class="btn btn-secondary">Cancel</a>
              <input type="submit" value="Create new Memeber" class="btn btn-success float-right">
            </div>
          </div>

        </form>

        <?php


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $sql = "select *from users where username='$uname'";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
          $br_name =  $_POST['branch'];
          $name = $_POST['name'];
          $gender = $_POST['gender'];
          $salary = $_POST['salary'];
          $email = $_POST['email'];
          $dob = $_POST['dob'];
          $address = $_POST['address'];
          $accountno = $_POST['accountno'];
          $experience = $_POST['experience'];
          $bloodgrp = $_POST['bloodgrp'];
          $education = $_POST['education'];
          // $designation = 'Trainer';
          $password = $name;

          $sql = "select *from users";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          $num = 1;
          while ($roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $num = $num + 1;
          }
          $username = $name . $num;



          $mobileno = $_POST['mobileno'];
          $array = explode(",", $mobileno);
          $test = count($array);


          $sql = "INSERT INTO USERS (USERNAME, PASSWORD, DOB, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME) VALUES ('$username', '$password', to_date('$dob', 'dd-mm-yyyy'), '$name', '$gender', '$email', '$address', '$bloodgrp', $accountno, '$br_name')";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);

          $sql = "select *from employee order by emp_id desc";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
          $emp_id = $row['EMP_ID'] + 1;
          $date = date("Y/m/d");

          // $bmi = ($weight) / (($height / 100) * ($height / 100));
          $sql = "INSERT INTO EMPLOYEE (USERNAME,EMP_ID,SALARY,EXPERIENCE,EDUCATION,DESIGNATION )VALUES('$username','$emp_id','$salary','$experience','$education','$designation')";
          $stid = oci_parse($conn, $sql);
          $rr = oci_execute($stid);



          $i = 0;
          while ($test <> $i) {
            $sql = "insert into user_mobileno (username, mobile_no) values ('$username', '$array[$i]')";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            $i = $i + 1;
          }
        }
        ?>



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
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="../../dist/js/demo.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#datepicker").datepicker();
    });
  </script>
</body>

</html>