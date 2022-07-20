<?php
session_start();
// this NEEDS TO BE AT THE TOP of the page before any output etc
$showname = $_SESSION['uname'];
$designation = $_SESSION['profation'];
$_SESSION['pk_amount'] = NULL;
$_SESSION['pk_id'] = NULL;
$costActive = false;
$packActive = false;
$durationActive = false;
if ($_GET != NULL && ($_GET['un'] != 'u' && $_GET['un'] != 'i' && $_GET['un'] != 'd' && $_GET['un'] != 'w')) {
  $uname = $_GET['un'];
} else {
  $uname = $_SESSION['uname'];
}
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['amount']) &&  isset($_POST['duration'])) {
      $sql = "select *from package order by pkg_id desc";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      $pkg_id = $row['PKG_ID'] + 1;
      $type = $_POST['type'];
      $name = $_POST['name'];
      $amount = $_POST['amount'];
      $duration = $_POST['duration'];
      $sql = "select *from users where username='$uname'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      $br_name = $roww['BR_NAME'];
      $sql = "insert into package (pkg_id, pkg_type, pkg_charge, pkg_name, pkg_duration) values($pkg_id, '$type', $amount, '$name', $duration)";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $sql = "insert into br_pkg (pkg_id, br_name) values($pkg_id, '$br_name')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);

      header("Location: packages_list.php?un=i");
    }
    if (isset($_POST['pkg_id'])) {

      if ($designation == 'Member') {

        $pkg_id = $_POST['pkg_id'];

        $sql = "select * from users where USERNAME = '$uname'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $br_name = $row["BR_NAME"];
        // $_SESSION['xxx'] = $br_name;
        $sql = "select *from income order by trx_id desc";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $trx_id = $row['TRX_ID'] + 1;
        $sql = "select * from package where pkg_id = '$pkg_id'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $_SESSION['pk_id'] = $row['PKG_ID'];
        $amount = $row['PKG_CHARGE'];
        $_SESSION['pk_amount'] = $amount;
        $mm = $_SESSION['pk_amount'];
        // $sql = "insert into income (trx_id, username, inc_amount, br_name, inc_type, inc_dateandtime) values($trx_id, '$uname', $amount, '$br_name', 'Member Payment', SYSTIMESTAMP)";
        // $stid = oci_parse($conn, $sql);
        // $r = oci_execute($stid);
        //updating month of the user
        $trig = "CREATE or REPLACE TRIGGER TRIGGER_INCOME
        AFTER UPDATE OF MEMBERSHIP_EXPIRY
        ON MEMBER
        FOR EACH ROW
        DECLARE
        var1 NUMBER;
        var2 varchar2(50);
        var3 varchar2(50);
        var4 varchar2(50);
        var5 varchar2(5);
        BEGIN
        dbms_output.put_line('trigger called');
        var2:= :new.username;
        var4:= 'Member Payment';
        SELECT PKG_CHARGE INTO var1 FROM PACKAGE NATURAL JOIN M_PKG WHERE USERNAME=var2;
        SELECT BR_NAME INTO var3 FROM USERS NATURAL JOIN M_PKG WHERE USERNAME=var2;
        INSERT INTO Income(TRX_ID,USERNAME,INC_AMOUNT,BR_NAME,INC_TYPE,INC_DATEANDTIME) VALUES (TRX_ID_GENERATE_SEQUENCE.nextval,var2,var1,var3,var4,SYSTIMESTAMP);
        END;
        ";
        $stid = oci_parse($conn, $trig);
        $r = oci_execute($stid);
        $package_ID = $_SESSION['pk_id'];

        $sql = "select PKG_DURATION from PACKAGE where PKG_ID= $package_ID";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $dur = $row['PKG_DURATION'];
        $_SESSION['xxx'] = $uname;
        //  echo $dur;
        $sql = "update member set MEMBERSHIP_EXPIRY =ADD_MONTHS(MEMBERSHIP_EXPIRY,$dur)  where username='$uname'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        // $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        echo var_dump($row);
      } else {
        // $_SESSION['xxx'] = $_POST;
        $pkg_id = $_POST['pkg_id'];
        $sql = "DELETE FROM package WHERE pkg_id = '$pkg_id'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        header("Location: packages_list.php?un=d");
      }
      // $x = $pkg_id;


    }
    if (isset($_POST['pkg_id2'])) {
      $pkg_id = $_POST['pkg_id2'];
      $duration = $_POST['duration1'];
      $charge = $_POST['amount1'];
      $sql = "update package set pkg_duration = $duration, pkg_charge = $charge  where pkg_id = $pkg_id";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);

      header("Location: packages_list.php?un=u");
    }
    if (isset($_POST['s_a']) && isset($_POST['f_a'])) {
      $s_a = $_POST['s_a'];
      $f_a = $_POST['f_a'];
      $costActive = true;
    }
    if (isset($_POST['pt'])) {
      $pt = $_POST['pt'];
      $packActive = true;
    }
    if (isset($_POST['du'])) {
      $du = $_POST['du'];
      $durationActive = true;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Packages List</title>
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
    <?php
    if ($designation == 'Member') {
      echo '
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
              <a href="member_profile.php" class="d-block">' . $uname . '
              </a>
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
                    <a href="member_db.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Member</p>
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
      if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
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
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content" style="margin-bottom:50px ;">
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <?php
                if ($designation == 'Member') {
                  echo "<h5 class='modal-title' id='exampleModalLabel1'>Are you sure you want to Purchase this package?</h5>";
                } else {
                  echo "<h5 class='modal-title' id='exampleModalLabel1'>Are you sure you want to remove this package?</h5>";
                }

                ?>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
              </div>
              <div class="modal-body">
                <form action="packages_list.php" method="POST">
                  <input type="hidden" name="pkg_id" id="pkg_id">
                  <div class="modal-body" style="float: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='packages_list.php'">Cancel</button>
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
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="bg-light clearfix">
  
                      <br>
                      <div class="container">
                        <div class="row">
  
                          <div class="form-group col-lg-3 col-12">
                            <h5 style="text-align: center;">Package Type</h5>
                            <br>
                            <div class="row">
                              <div class="form-group col-lg-12 col-12">
                                <form action="packages_list.php" method="POST">
                                  <div class="row">
                                    <div class="form-group col-lg-7 col-12">
                                      <input type="text" placeholder="Type" class="form-control" id="pt" name="pt">
                                    </div>
                                    <div class="form-group col-lg-5 col-12">
                                      <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
  
                          </div>
                          <div class="form-group col-lg-5 col-12">
                            <h5 style="text-align: center;">Charge</h5>
                            <br>
                            <form action="packages_list.php" method="POST">
                              <div class="row">
                                <div class="form-group col-lg-5 col-12">
                                  <input type="text" placeholder="From" class="form-control" id="s_a" name="s_a" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                  <input type="text" placeholder="To" class="form-control" id="f_a" name="f_a">
                                </div>
                                <div class="form-group col-lg-3 col-12">
                                  <button type="submit" class="btn btn-secondary">Search</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="form-group col-lg-4 col-12">
                            <h5 style="text-align: center;">Duration</h5>
                            <br>
                            <form action="packages_list.php" method="POST">
                              <div class="row">
                                <div class="form-group col-lg-8 col-12">
                                  <input type="text" placeholder="Months" class="form-control" id="du" name="du">
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
              <h2 style="margin-left: 25px;">Package Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <?php
              if ($designation <> 'Member') {
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
                  echo '
                <button type="button" class="insert btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Add New</button>
              
                ';
                }
              }
              ?>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                      <form action="packages_list.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" name="snoEdit" id="snoEdit">
                          <div class="form-group">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-6 col-12">
                              <label for="amount">Charge</label>
                              <input type="text" class="form-control" id="amount" name="amount" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                              <label for="type">Package Type</label>
                              <select name="type" id="type" class="form-select" aria-label="Default select example" style="width: 208px; height: 37px;">
                                <option selected value="Fitness">Fitness</option>
                                <option value="Light Gym">Light Gym</option>
                                <option value="Yoga">Yoga</option>
                                <option value="Body Building"> Body Building</option>
                                <option value="Summer Package"> Summer Package</option>
                                <option value="Winter Package"> Winter Package</option>
                                <option value="Special Package"> Special Package</option>
                                <option value="Weight Lifting"> Weight Lifting</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" aria-describedby="emailHelp">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add Package</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Insert Modal -->
            </div>
          </div>
        </div>


        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <!-- <button type="button" class="insert btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Add New</button> -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel2">Edit Info</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <form action="packages_list.php" method="POST">
                        <div class="modal-body">

                          <input type="hidden" name="pkg_id2" id="pkg_id2">
                          <div class="row">
                            <div class="form-group col-lg-6 col-12">
                              <label for="amount1">Charge</label>
                              <input type="text" class="form-control" id="amount1" name="amount1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                              <label for="duration1">Duration</label>
                              <input type="text" class="form-control" id="duration1" name="duration1" aria-describedby="emailHelp">
                            </div>

                          </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='packages_list.php'">Close</button>
                          <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /Insert Modal -->


            </div>
          </div>
        </div>






        <div class="card-body" style="margin-top:1%">
          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th scope="col">Package ID</th>
                <th scope="col">Package Name</th>
                <th scope="col">Package Type</th>
                <th scope="col">Charge</th>
                <th scope="col">Duration (months)</th>
                <?php

                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
                  echo '<th scope="col">Action</th>';
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              // $br_name = $packageInfo["BR_NAME"];
              if ($costActive) {
                $sql = "select *from branch natural join br_pkg natural join package where br_name = (select br_name from users where username = '$uname') and $s_a <= PKG_CHARGE and $f_a >= PKG_CHARGE";
              } elseif ($durationActive) {
                // $_SESSION['xxx'] = $du;
                $sql = "select *from branch natural join br_pkg natural join package where br_name = (select br_name from users where username = '$uname') and PKG_DURATION	 = $du";
              } elseif ($packActive) {
                $sql = "select *from branch natural join br_pkg natural join package where br_name = (select br_name from users where username = '$uname') and PKG_TYPE = '$pt'";
              } else {
                $sql = "select *from branch natural join br_pkg natural join package where br_name = (select br_name from users where username = '$uname')";
              }

              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "
              <tr>
              <th scope='row'>" . $row["PKG_ID"] . "</th>
              <td>" . $row["PKG_NAME"] . "</td>
              <td>" . $row["PKG_TYPE"] . "</td>
              <td>" . $row["PKG_CHARGE"] . "</td>
              <td>" . $row["PKG_DURATION"] . "</td>";
                if ($designation == 'Member') {
                  echo "<td> <button class='delete btn btn-sm btn-success'>Purchase</button>";
                } else {
                  if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
                    echo "<td> <button class='delete btn btn-sm btn-danger'>Remove</button> <button class='update btn btn-sm btn-primary' id=" . $row['BR_NAME'] . ">Edit</button></td>";
                  }
                  echo "</tr>
              ";
                }
              }
              ?>
            </tbody>
          </table>
      </section>
      <?php

      //For checking the error

      ?>
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
      <strong>Copyright &copy; 2014-2021 <a href="#">Gym Management System</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.2.0-rc -->
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
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    inserts = document.getElementsByClassName('insert');
    Array.from(inserts).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("insert ", e.target);
        // $('#exampleModal').modal('toggle');
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("delete ", );
        tr = e.target.parentNode.parentNode;
        pkg_id.value = tr.getElementsByTagName("th")[0].innerText;
        console.log(pkg_id.value);
        $('#exampleModal1').modal('toggle');
      })
    })
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("update ", );
        tr = e.target.parentNode.parentNode;
        // uname.value = e.target.id;
        // designation.value = tr.id;
        pkg_id2.value = tr.getElementsByTagName("th")[0].innerText;
        amount1.value = tr.getElementsByTagName("td")[2].innerText;
        duration1.value = tr.getElementsByTagName("td")[3].innerText;
        console.log(pkg_id2.value, amount.value, duration.value);
        // console.log(emp_id);
        $('#exampleModal2').modal('toggle');
      })
    })
  </script>
</body>

</html>