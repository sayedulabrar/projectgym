<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$test = NULL;
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "select *from users where username='$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $br_name = $roww['BR_NAME'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $accountno = $_POST['accountno'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $outcome = $_POST['outcome'];
    $bloodgrp = $_POST['bloodgrp'];
    $trainer = $_POST['trainer'];
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

    $sql = "insert into users (username, password, dob, name, gender, email, address, blood_grp, account_no, br_name) values ('$username', '$password', to_date('$dob', 'mm/dd/yyyy'), '$name', '$gender', '$email', '$address', '$bloodgrp', $accountno, '$br_name')";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);

    $sql = "select *from member order by mem_id desc";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $mem_id = $row['MEM_ID'] + 1;
    $date = date("Y/m/d");

    $bmi = ($weight) / (($height / 100) * ($height / 100));
    $sql = "insert into member(mem_id, username, mem_height, mem_weight, expected_outcome, trainer, memb_bmi, membership_expiry) values($mem_id, '$username', $height, $weight, '$outcome', '$trainer', $bmi, to_date('$date', 'yyyy/mm/dd')+30)";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $i = 0;
    while ($test <> $i) {
      $sql = "insert into user_mobileno (username, mobile_no) values ('$username', '$array[$i]')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $i = $i + 1;
    }
    header("Location: member_list.php?un=a");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Member</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="  plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="  dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="  index3.html" class="brand-link">
        <img src="  dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fitness Mania</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="  dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="employee_profile.php" class="d-block">
              <?php echo $uname ?>
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
                  <a href=" pages/mailbox/mailbox.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href=" pages/mailbox/compose.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
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
              <h1> Add Member</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="manager_db.php">Home</a></li>
                <li class="breadcrumb-item active"> Add Member</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content" style="margin-bottom:50px ;">
        <form action="add_member.php" method="POST">
          <div class="row">
            <div class="col-lg-6 col-md-12">
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
                    <br>
                    <select name="gender" id="gender" class="form-select" aria-label="Default select example" style="width: 576px; height: 37px;">
                      <option selected value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="dob"> Date of Birth</label>
                    <input type="text" id="dob" name="dob" class="form-control">
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
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                  </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="form-group">
                    <label for="accountno">Account No</label>
                    <input type="number" id="accountno" name="accountno" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="height">Height</label>
                    <input type="number" id="height" name="height" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" id="weight" name="weight" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="outcome">Expected Outcome</label>
                    <input type="text" id="outcome" name="outcome" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="trainer">Assigned Trainer</label>
                    <input type="text" id="trainer" name="trainer" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="bloodgrp">Blood Group</label>
                    <br>
                    <select name="bloodgrp" id="bloodgrp" class="form-select" aria-label="Default select example" style="width: 576px; height: 37px;">
                      <option selected value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      
                    </select>
                  </div>

                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <a href="member_list.php" class="btn btn-secondary">Cancel</a>
              <input type="submit" value="Create new Memeber" class="btn btn-success float-right">
            </div>
          </div>
        </form>
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
  <script src="  plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="  plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="  dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="  dist/js/demo.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#dob").datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
  </script>
</body>

</html>