<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$designation = $_SESSION['designation'];
$test = NULL;
$link = NULL;
$wrongBranch = false;
if ($designation == 'Trainer') {
  $link = 'trainer_list.php';
}
if ($designation == 'Receptionist') {
  $link = 'receptionist_list.php';
}
if ($designation == 'Manager') {
  $link = 'manager_list.php';
}
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
    if ($designation == 'Manager') {
      $br_name = $_POST['br_name'];
    } else {
      $br_name = $roww['BR_NAME'];
    }
    $sql = "select * from branch where br_name = '$br_name'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    if ($row == NULL) {
      $wrongBranch = true;
    } else {
      // PER_EMP_ID_SQ

      $name = $_POST['name'];
      $gender = $_POST['gender'];
      $email = $_POST['email'];
      $dob = $_POST['datepicker'];
      $address = $_POST['address'];
      $accountno = $_POST['accountno'];
      $salary = $_POST['salary'];
      $shift = $_POST['shift'];
      $experience = $_POST['experience'];
      $bloodgrp = $_POST['bloodgrp'];
      $education = $_POST['education'];
      // $designation = 'Trainer';
      $password = $name;
      $sql = "select PER_EMP_ID_SQ.NEXTVAL from dual";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      $x = $row['NEXTVAL'];
      $username = $name . $x;

      $_SESSION['xxx'] = $username;

      $mobileno = $_POST['mobileno'];
      $array = explode(",", $mobileno);
      $test = count($array);
      $sql = "insert into users (username, password, dob, name, gender, email, address, blood_grp, account_no, br_name) values ('$username', '$password', to_date('$dob', 'mm/dd/yyyy'), '$name', '$gender', '$email', '$address', '$bloodgrp', $accountno, '$br_name')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $date = date("Y/m/d");
      $sql = "insert into employee(emp_id, username, salary, shift, experience, education, Num_of_rating, rating_value, designation) values(PER_EMP_ID_SQ.currval, '$username', $salary, $shift, '$experience', '$education', 0, 0, '$designation')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $i = 0;
      while ($test <> $i) {
        $sql = "insert into user_mobileno (username, mobile_no) values ('$username', '$array[$i]')";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $i = $i + 1;
      }
      if ($designation == 'Trainer') {
        header("Location: trainer_list.php");
      } elseif ($designation == 'Receptionist') {
        header("Location: receptionist_list.php");
      } elseif ($designation == 'Manager') {
        header("Location: manager_list.php");
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
  <title>Add Employee</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <!-- Theme style -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php
    if ($designation == 'Manager') {
      echo '
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="#" class="brand-link">
            <img src="      dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Fitness Maina</span>
          </a>
          <!-- Navbar -->
          
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="      dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="admin_profile.php" class="d-block">' . $_SESSION['uname'] . '</a>
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
                
                
               
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
      
        ';
    } else {
      echo '
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="#" class="brand-link">
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
                <a href="employee_profile.php" class="d-block">' . $uname . '
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
                      <a href=" pages/mailbox/mailbox.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inbox</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href=" pages/mailbox/compose.php" class="nav-link">
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
    
        ';
    }
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: 0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <?php
        if ($wrongBranch) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Given Branch does not exist
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
        }
        ?>
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add <?php
                      if ($designation == 'Manager') {
                        echo "Manager";
                      } else {
                        echo "Employee";
                      }
                      ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="
                <?php
                if ($designation == 'Manager') {
                  echo "admin_db.php";
                } else echo "manager_db.php";
                ?>
                ">Home</a></li>
                <li class="breadcrumb-item active"> Add <?php
                                                        if ($designation == 'Manager') {
                                                          echo "Manager";
                                                        } else {
                                                          echo "Employee";
                                                        }
                                                        ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content" style="margin-bottom:50px ;">
        <form action="add_employee.php" method="POST">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <!-- username and password jokhon ekjon member ke add kora hobe by default dewa hobe or name and password o oita  -->
                  <!-- pore user oita change korte parbe anytime jokhon e o cay from his profile -->
                  <div class="form-group">
                    <label for="name"> Name <span style="color:#FF0000">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required>
                  </div>
                  <?php
                  if ($designation == 'Manager') {
                    echo '
                    <div class="form-group">
                      <label for="br_name">Branch Name</label>
                      
                      <select class="select2" name="br_name" id="br_name" style="width: 100%; height: 38px;">';

                      $sql = "select *from branch";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                      
                      while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '<option value="' . $row["BR_NAME"] . '">' . $row["BR_NAME"] . '</option>';
                      }


                    echo '</select>
                    </div>
                    
                  ';
                  }
                  ?>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-select" aria-label="Default select example" style="width: 576px; height: 37px;">
                      <option selected value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Email <span style="color:#FF0000">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="mobileno">Mobile No</label>
                    <input type="text" id="mobileno" name="mobileno" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="bloodgrp">Blood Group</label>
                    <select name="bloodgrp" id="bloodgrp" class="form-select" aria-label="Default select example" style="width: 100%; height: 37px;">
                      <option value="A+">A+</option>
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
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="form-group">
                    <label for="dob">Date of Birth <span style="color:#FF0000">*</span></label>
                    <input type="text" id="datepicker" name="datepicker" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="accountno">Account No <span style="color:#FF0000">*</span></label>
                    <input type="number" id="accountno" name="accountno" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="experience">Experience (Years) <span style="color:#FF0000">*</span></label>
                    <input type="number" id="experience" name="experience" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="salary">Salary (BDT) <span style="color:#FF0000">*</span></label>
                    <input type="number" id="salary" name="salary" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="shift">Shift</label>
                    <select name="shift" id="shift" class="form-select" aria-label="Default select example" style="width: 576px; height: 37px;">
                      <option value="1">Morning</option>
                      <option value="2">Evening</option>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="education">Education (Hightest Degree Only)</label>
                    <input type="text" id="education" name="education" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              
              <input type="submit" value="Create new Employee" class="btn btn-success float-right">
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
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="  dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="  dist/js/demo.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
  </script>
  <script>
    $(function() {
      $('.select2').select2()
    });
  </script>
</body>

</html>