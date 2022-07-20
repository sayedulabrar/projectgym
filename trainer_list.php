<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output et
$showname = $_SESSION['uname'];
$designation = $_SESSION['profation'];
$ratingActive = false;
$ageActive = false;
$salaryActive = false;
if ($_GET != NULL && ($_GET['un'] != 'u' && $_GET['un'] != 'i' && $_GET['un'] != 'd' && $_GET['un'] != 'w' && $_GET['un'] != 'e' )) {
  $uname = $_GET['un'];
} else {
  $uname = $_SESSION['uname'];
}


$_SESSION['designation'] = 'Trainer';
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $sql = "select * from member where trainer = '$username'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if ($row == NULL) {
        $sql = "DELETE FROM users WHERE username = '$username'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        header("Location: trainer_list.php?un=d");
      } else {
        header("Location: trainer_list.php?un=w");
      }
    }

    if (isset($_POST['uname']) && isset($_POST['emp_id'])) {
      
      $br_name = $_POST['uname'];
      $salary = $_POST['salary'];
      $emp_id = $_POST['emp_id'];
      
      $designation = $_POST['designation'];
      
      $sql = "select * from branch where br_name = '$br_name'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if($row) {

        $shift = $_POST['shift'];
        $_SESSION['xxx'] = $shift;
        $sql = "update employee set salary = $salary, shift = $shift, designation = '$designation'  where emp_id = $emp_id";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $sql = "select * from employee where emp_id = $emp_id";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $username = $row['USERNAME'];
        $sql = "update users set br_name = '$br_name' where username = '$username'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);

        header("Location: trainer_list.php?un=u");
      }
      else {
        header("Location: trainer_list.php?un=e");
      }
    }
    if(isset($_POST['s_a']) && isset($_POST['f_a'])) {
      $s_a = $_POST['s_a'];
      $f_a = $_POST['f_a'];
      $ageActive = true;
    }
    if(isset($_POST['s_r']) && isset($_POST['f_r'])) {
      $s_r = $_POST['s_r'];
      $f_r = $_POST['f_r'];
      $ratingActive = true;
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
  <title>Trainers List</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome Icons -->
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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

    <?php
    if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e'))) {
      echo '
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Fitness Mania</span>
            </a>
          
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="employee_profile.php" class="d-block">';
      echo $uname;
      echo '</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
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
<a href="admin_profile.php" class="d-block">';
      echo $showname;
      echo '</a>  
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
                <form action="trainer_list.php" method="POST">
                  <input type="hidden" name="username" id="username">
                  <div class="modal-body" style="float: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='trainer_list.php'">Cancel</button>
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
                <form action="trainer_list.php" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="emp_id" id="emp_id">

                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label for="select2">Branch Name</label>
                        <select class="select2" name="uname" id = "uname" style="width: 100%; height: 38px;">
                        <?php

                          $sql = "select *from branch";
                          $stid = oci_parse($conn, $sql);
                          $r = oci_execute($stid);
                          $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                          while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS))
                          {
                            echo '<option value="'.$row["BR_NAME"].'">'.$row["BR_NAME"].'</option>';
                          }
                          
                        ?>
                        </select>
                       
                      </div>
                      <div class="form-group col-lg-6 col-12">
                        <label for="designation">Designation</label>
                        <!-- <input type="text" class="form-control" id="designation" name="designation" aria-describedby="emailHelp"> -->
                        <select name="designation" id="designation" class="form-select" aria-label="Default select example" style="width: 208px; height: 37px;">
                          <option selected value="Trainer">Trainer</option>
                          <option value="Receptionist">Receptionist</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label for="salary">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group col-lg-6 col-12">
                        <label for="shift">Shift</label>
                        <select name="shift" id="shift" class="form-select" aria-label="Default select example" style="width: 208px; height: 37px;">
                          <option value="1">Morning</option>
                          <option value="2">Evening</option>
                          
                        </select>
                        <!-- <input type="text" class="form-control" id="shift" name="shift" aria-describedby="emailHelp"> -->
                      </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='trainer_list.php'">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <?php
        if ($_GET) {
          if ($_GET['un'] == 'i') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Successfully inserted
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          } elseif ($_GET['un'] == 'u') {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Successfully Updated
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          } elseif ($_GET['un'] == 'd') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Successfully Deleted
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          } elseif ($_GET['un'] == 'w') {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Cannot remove this trainer as some members are still assigned to him
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
          elseif ($_GET['un'] == 'e') {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Given Branch Name does not exist
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }

        ?>
        <?php
        if($designation != 'Admin') {
          echo '
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
                <div class="form-group col-lg-4 col-12" >
                  <h5 style="text-align: center;">Rating</h5>  
                  <br>
                  <form action="trainer_list.php" method = "POST">
                    <div class="row" >
                      <div class="form-group col-lg-4 col-12" >
                        <input type="number" placeholder="From" class="form-control" id="s_r" name="s_r" aria-describedby="emailHelp">  
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <input type="number" placeholder="To" class="form-control" id="f_r" name="f_r">
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <button type="submit" class="btn btn-secondary">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="form-group col-lg-4 col-12">
                  <h5 style="text-align: center;">Salary</h5>
                  <br>
                  <form action="trainer_list.php" method = "POST">
                    <div class="row">
                      <div class="form-group col-lg-4 col-12">
                        <input type="number" placeholder="From" class="form-control" id="s_s" name="s_s" aria-describedby="emailHelp">  
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <input type="number" placeholder="To" class="form-control" id="f_s" name="f_s">
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <button type="submit" class="btn btn-secondary">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="form-group col-lg-4 col-12">
                  <h5 style="text-align: center;">Age</h5>
                  <br>
                  <form action="trainer_list.php" method = "POST">
                    <div class="row">
                      <div class="form-group col-lg-4 col-12">
                        <input type="number" placeholder="From" class="form-control" id="s_a" name="s_a" aria-describedby="emailHelp">  
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <input type="number" placeholder="To" class="form-control" id="f_a" name="f_a">
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
      
          ';
        }
        ?>
        
        
        
        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12">
              <h2 style="margin-left: 25px;">Trainer Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <?php
              if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e' ))) {
                echo '<button type="button" class="insert btn btn-success float-right" data-toggle="modal"
                  data-target="#exampleModal" onclick="window.location.href=\'add_employee.php?un=' . $uname . '\'">Add
                  New</button>';
              }
              ?>


            </div>
          </div>
        </div>

        <div class="card-body" style="margin-top:1%">

          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Rating</th>
                <th scope="col">Age</th>
                <th scope="col">Salary</th>
                <th scope="col">Shift</th>
                <?php
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e'))) {
                  echo '<th scope="col">Action</th>';
                }
                ?>

              </tr>
            </thead>
            <tbody>
              <?php
              if($ratingActive) {
                $sql = "select EMP_ID, NAME, GENDER, RATING_VALUE, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where br_name = (select br_name from users where username = '$uname') and designation = 'Trainer'";
              }
              elseif($ageActive) {
                $sql = "select EMP_ID, NAME, GENDER, RATING_VALUE, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where br_name = (select br_name from users where username = '$uname') and designation = 'Trainer' and floor((SYSDATE - DOB)/365) >= $s_a and floor((SYSDATE - DOB)/365) <= $f_a";
              }
              elseif($salaryActive) {
                $sql = "select EMP_ID, NAME, GENDER, RATING_VALUE, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where br_name = (select br_name from users where username = '$uname') and designation = 'Trainer' and salary >=$s_s and salary <= $f_s";
              }
              else {
                $sql = "select EMP_ID, NAME, GENDER, RATING_VALUE, SALARY, SYSDATE - DOB, USERNAME, BR_NAME, SHIFT from users natural join employee where br_name = (select br_name from users where username = '$uname') and designation = 'Trainer'";
              }
              
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $un = $row['USERNAME'];
                $unm = $row["USERNAME"];
                $sql = "select * from member where trainer='$unm'";
                $stid1 = oci_parse($conn, $sql);
                $r = oci_execute($stid1);
                
                $s=0;
                $cnt=0;
                while($row1 = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS))
                {
                        
                        if($row1['RATING']<>NULL)
                        {
                            $s=$s+$row1['RATING'];
                            $cnt=$cnt+1;
                            
                        }
                }
                    if($cnt==0)
                    {
                        $ratei =  0;
                    }
                    else
                    {
                        $ratei =  number_format($s/$cnt,2);
                    }
                  if($ratingActive == false || ($ratingActive && $ratei >=$s_r && $ratei <=$f_r)) {
  
                echo "
              <tr id='Trainer'>
              <th>" . $row["EMP_ID"] . "</th>
              <td>";
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e'))) {
                  echo "<a href='employee_profile.php?un =" . $un . " '>";
                }
                echo $row["NAME"];
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e'))) {
                  echo  "</a>";
                }
                echo "</td>
              <td>" . $row["GENDER"] . "</td>
              <td>";
              
              echo $ratei;
              
              echo "</td>
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
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u' || $_GET['un'] == 'e'))) {
                  echo "<td> <button class='delete btn btn-sm btn-danger' id=" . $row['USERNAME'] . ">Remove</button> <button class='update btn btn-sm btn-primary' id=" . $row['BR_NAME'] . ">Edit</button> </td>";
                }
                echo "</tr>
              ";
                // ECHO var_dump($row);
              }
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
  
  <!-- Bootstrap -->
  
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
  
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  
  
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("delete ", );
        tr = e.target.parentNode.parentNode;
        username.value = e.target.id;
        console.log(username.value);

        $('#exampleModal').modal('toggle');
      })
    })
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("update ", );
        tr = e.target.parentNode.parentNode;
        uname.value = e.target.id;
        designation.value = tr.id;
        // shift.value = tr.getElementsByTagName("td")[5].innerText;
        salary.value = tr.getElementsByTagName("td")[4].innerText;
        emp_id.value = tr.getElementsByTagName("th")[0].innerText;
        // console.log(tr);
        $('#exampleModal1').modal('toggle');
      })
    })
  </script>
  <script>
    $('#uname').select2({
        dropdownParent: $('#exampleModal1')
    });
</script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  
</body>

</html>