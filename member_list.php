<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$showname = $_SESSION['uname'];
$wrongUname = false;
$unameActive = false;
$designation = $_SESSION['profation'];
$ageActive = false;
$ml = false;
$mo = false;
if ($_GET != NULL && $_GET['un'] != 'a') {
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
    if(isset($_POST['un'])) {
      $username = $_POST['un'];
      $sql = "select * from employee where USERNAME = '$username' and designation = 'Trainer'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if($row) {
        $unameActive = true;
      }
      else {
        $wrongUname = true;
      }
    }
    if(isset($_POST['s_a']) && isset($_POST['f_a'])) {
      $s_a = $_POST['s_a'];
      $f_a = $_POST['f_a'];
      $ageActive = true;
    }
    if(isset($_POST['ml'])) {
      $xx = $_POST['ml'];
      $ml = true;
    }
    if(isset($_POST['mo'])) {
      $xx = $_POST['mo'];
      $mo = true;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Member List</title>

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

    <?php
    if($designation == "receptionist") {
      echo '
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
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
              <a href="employee_profile.php?un_=receptionist" class="d-block">'.
              $uname
              .'</a>
            </div>
          </div>
  
          
  
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             
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
                    <a href="receptionist.php" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Receptionist</p>
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
                <ul class="nav nav-treeview">';
                      echo "<li class='nav-item'>                
                      <a href='pages/mailbox/mailbox.php?un=" . $uname . "' class='nav-link'>
                      <i class='far fa-circle nav-icon'></i>
                      <p>Inbox</p>
                      </a>         
   </li>";
                      echo "<li class='nav-item'>                
                      <a href='pages/mailbox/compose.php?un=" . $uname . "' class='nav-link'>
                      <i class='far fa-circle nav-icon'></i>
                      <p>Compose</p>
                      </a>         
                      </li>";
  
            echo    ' </ul>
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
    else {
    if ($_GET == NULL || ($_GET != NULL && $_GET['un'] == 'a')) {
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
        
            ';
    }
  }
    ?>
    
    <!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content" style="margin-bottom:50px ;">
        <?php
        if (isset($_GET['un']) && $_GET['un'] == 'a') {

          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Successfully inserted
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }
        ?>
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
                      
                      <div class="form-group col-lg-5 col-12">
                        <h5 style="text-align: center;">Membership Left</h5>
                        <br>
                        <div class="row">
                          <div class="form-group col-lg-6 col-12">
                            <form action="member_list.php" method = "POST">
                              <div class="row">
                                <div class="form-group col-lg-7 col-12">
                                  <input type="number" placeholder="Days or less" class="form-control" id="ml" name="ml">
                                </div>
                                <div class="form-group col-lg-5 col-12">
                                  <button type="submit" class="btn btn-secondary">Search</button>
                                  
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="form-group col-lg-6 col-12">
                            <form action="member_list.php" method = "POST">
                              <div class="row">
                                <div class="form-group col-lg-7 col-12">
                                  <input type="number" placeholder="Days or More" class="form-control" id="mo" name="mo">
                                </div>
                                <div class="form-group col-lg-5 col-12">
                                  <button type="submit" class="btn btn-secondary">Search</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-group col-lg-4 col-12" >
                        <h5 style="text-align: center;">Age</h5>  
                        <br>
                        <form action="member_list.php" method = "POST">
                          <div class="row" >
                            <div class="form-group col-lg-5 col-12" >
                              <input type="number" placeholder="From" class="form-control" id="s_a" name="s_a" aria-describedby="emailHelp">  
                            </div>
                            <div class="form-group col-lg-4 col-12">
                              <input type="number" placeholder="To" class="form-control" id="f_a" name="f_a">
                            </div>
                            <div class="form-group col-lg-3 col-12">
                              <button type="submit" class="btn btn-secondary">Search</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="form-group col-lg-3 col-12" >
                        <h5 style="text-align: center;">Trainer</h5>  
                        <br>
                        <form action="member_list.php" method = "POST">
                          <div class="row" >
                            <div class="form-group col-lg-8 col-12">
                              <input type="text" placeholder="Username" class="form-control" id="un" name="un">
                            </div>
                            <div class="form-group col-lg-4 col-12">
                              <button type="submit" class="btn btn-secondary">Search</button>
                              
                            </div>
                          </div>
                          <?php
                                    if($wrongUname) {
                                      echo '
                                      <p style="color: red;"> Wrong Username</p>
                                      ';
                                    } 
                                  ?>
                        </form>
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
              <h2 style="margin-left: 25px;">Member Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->

              <?php
              if ($_GET == NULL || ($_GET != NULL && $_GET['un'] == 'a')) {
                echo '<button type="button" class="insert btn btn-success float-right" data-toggle="modal"
                                data-target="#exampleModal" onclick="window.location.href=\'add_member.php?un=' . $uname . '\'">Add
                                New</button>';
              }
              ?>
              <!-- <button type="button" class="insert btn btn-success float-right" data-toggle="modal"
                                data-target="#exampleModal" onclick="window.location.href='add_member.php'">Add
                                New</button> -->


            </div>
          </div>
        </div>




        <div class="card-body" style="margin-top:1%">

          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Trainer Name</th>
                <th scope="col">Membership Expiry Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($unameActive) {
                $sql = "select NAME, GENDER, USERNAME, BR_NAME, SYSDATE - DOB, TRAINER, MEMBERSHIP_EXPIRY from users natural join member where br_name = (select br_name from users where username = '$uname') and trainer = '$username'";  
              }
              elseif($ageActive) {
                $sql = "select NAME, GENDER, USERNAME, BR_NAME, SYSDATE - DOB, TRAINER, MEMBERSHIP_EXPIRY from users natural join member where br_name = (select br_name from users where username = '$uname') and floor((SYSDATE - DOB)/365) >= $s_a and floor((SYSDATE - DOB)/365) <= $f_a";
              }
              elseif($ml) {
                $sql = "select NAME, GENDER, USERNAME, BR_NAME, SYSDATE - DOB, TRAINER, MEMBERSHIP_EXPIRY from users natural join member where br_name = (select br_name from users where username = '$uname') and (MEMBERSHIP_EXPIRY - SYSDATE) <= $xx";
              }
              elseif($mo) {
                $sql = "select NAME, GENDER, USERNAME, BR_NAME, SYSDATE - DOB, TRAINER, MEMBERSHIP_EXPIRY from users natural join member where br_name = (select br_name from users where username = '$uname') and (MEMBERSHIP_EXPIRY - SYSDATE) >= $xx";
              }
              else {
                $sql = "select NAME, GENDER, USERNAME, BR_NAME, SYSDATE - DOB, TRAINER, MEMBERSHIP_EXPIRY from users natural join member where br_name = (select br_name from users where username = '$uname')";
              }
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $un = $row['USERNAME'];
                echo "
                                <tr>
                                <td>";
                if ($_GET == NULL || ($_GET != NULL && $_GET['un'] == 'a')) {
                  echo "<a href='member_profile.php?un=" . $un . "'>";
                }
                echo  $row["NAME"];
                if ($_GET == NULL || ($_GET != NULL && $_GET['un'] == 'a')) {
                  echo "</a>";
                }
                echo "</td>
                <td>" . $row["GENDER"] . "</td>
                <td>";
                echo floor($row["SYSDATE-DOB"] / 365);
                echo "</td>
                <td>" . $row["TRAINER"] . "</td>
                <td>" . $row["MEMBERSHIP_EXPIRY"] . "</td>
                </tr>
                ";
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>