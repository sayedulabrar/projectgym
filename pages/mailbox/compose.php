<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$designation = $_SESSION['profation'];   // aita get method dia ante hobe link er shathe pataia.
// $_SESSION['xxx'] = $designation;
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
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
  <title>Compose</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item float-right">
          <button onclick="window.location.href='../../index.php'" type="button" class="btn btn-primary">Logout</button>
        </li>



      </ul>
    </nav>
    <!-- /.navbar -->

    <?php
    if($designation == "Receptionist") {
      echo '
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Fitness Mania</span>
        </a>
  
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="../../employee_profile.php" class="d-block">'.
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
                    <a href="../../receptionist.php" class="nav-link ">
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
                      <a href='mailbox.php?un=" . $uname . "' class='nav-link'>
                      <i class='far fa-circle nav-icon'></i>
                      <p>Inbox</p>
                      </a>         
   </li>";
                      echo "<li class='nav-item'>                
                      <a href='compose.php?un=" . $uname . "' class='nav-link'>
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
    elseif ($designation == 'Member') {
      echo '
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
            <a href="member_profile.php" class="d-block">' .
        $uname .
        '</a>
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
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="member_db.php" class="nav-link ">
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
                <!-- <li class="nav-item">
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
                </li> -->

                ';
      echo "<li class='nav-item'>

                                
                                    
                                         <a href='mailbox.php?un=" . $uname . "' class='nav-link'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Inbox</p>
                                         </a>

                                   
                                </li>";


      echo "<li class='nav-item'>                    
                                <a href='compose.php?un=" . $uname . "' class='nav-link'>
                                <i class='far fa-circle nav-icon'></i>
                                <p>Compose</p>
                                </a>
                                </li>";

      echo '</ul>
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
    } elseif ($designation == 'Manager') {
      echo '
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Fitness Mania</span>
            </a>
          
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="../../employee_profile.php" class="d-block">';
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
                            <a href="../../manager_db.php" class="nav-link">
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
                            <a href="mailbox.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="compose.php" class="nav-link">
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
    } elseif ($designation == 'Trainer') {
      echo '
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fitness Mania</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="../../employee_profile.php" class="d-block">'
        . $uname .
        '</a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="../../trainer_db.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trainer</p>
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
                  <a href='mailbox.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Inbox</p>
                  </a>
</li>";


      echo "<li class='nav-item'>                    
                  <a href='compose.php' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Compose</p>
                  </a>
                  </li>";
      echo '  <!-- <li class="nav-item">
                  <a href="compose.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li> -->

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
    }
    elseif($designation == 'Admin') {
      echo '
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Fitness Mania</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="../../admin_profile.php" class="d-block">'. $uname. '
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
                  <a href="../../admin_db.php" class="nav-link">
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
                  <a href="mailbox.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="compose.php" class="nav-link">
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
    if($designation == "Receptionist") {
      echo '
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Fitness Mania</span>
        </a>
  
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="../../employee_profile.php" class="d-block">'.
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
                    <a href="../../receptionist.php" class="nav-link ">
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
                      <a href='mailbox.php?un=" . $uname . "' class='nav-link'>
                      <i class='far fa-circle nav-icon'></i>
                      <p>Inbox</p>
                      </a>         
   </li>";
                      echo "<li class='nav-item'>                
                      <a href='compose.php?un=" . $uname . "' class='nav-link'>
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
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: 0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Compose</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../../admin_db.php">Home</a></li>
                <li class="breadcrumb-item active">Compose</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <?php

      if ($designation != 'Member') {
        $sql = "select EMP_ID from EMPLOYEE where USERNAME='$uname'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $senderid = $row['EMP_ID'];
      } else {
        $sql = "select MEM_ID from MEMBER where USERNAME='$uname'";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $senderid = $row['MEM_ID'];
      }


      ?>










      <section class="content" style="margin-bottom:50px ;">
        <form action="compose.php" method="POST">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card card-primary">
                <div class="card-body">
                  <!-- username and password jokhon ekjon member ke add kora hobe by default dewa hobe or name and password o oita  -->
                  <!-- pore user oita change korte parbe anytime jokhon e o cay from his profile -->
                  <div class="form-group">
                    <label for="to">To :</label>
                    <input type="text" id="to" name="to" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="subject"> Subject :</label>
                    <input type="text" id="subject" name="subject" class="form-control">
                  </div>
                  <!-- <div class="form-group">
                    <textarea id="details compose-textarea" name="details" class="form-control" style="height: 300px">
                      
                    </textarea>
                </div> -->

                  <div class="form-group">
                    <input type="text" id="details" name="details" class="form-control" style="height: 300px">
                  </div>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>


          </div>
          <div class="row">
            <div class="col-12">
              <a href="compose.php" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-success float-right"><i class="far fa-envelope"></i> Send</button>
            </div>
          </div>

        </form>

        <?php


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

          $username = $_POST['to'];
          $sql = "select COUNT(*) from EMPLOYEE where USERNAME='$username'";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);


          $x = $roww['COUNT(*)'];

          if ($x < 1) {


            $sql = "select MEM_ID from MEMBER where USERNAME='$username'";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

            if ($row != NULL) {
              $sub = $_POST['subject'];
              $des = $_POST['details'];
              $sid = $senderid;
              $to = $row['MEM_ID'];
            } else {
              echo "<div class='alert alert-warning alert-dismissible fade show my-4' role='alert'>
  <strong>Sorry !</strong> Invalid Username.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";

              $_POST = array();
            }
          } else {

            $sql = "select EMP_ID from EMPLOYEE where USERNAME='$username'";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);


            $sub = $_POST['subject'];
            $des = $_POST['details'];
            $sid = $senderid;
            $to = $row['EMP_ID'];
          }





          if ($row != NULL) {

            $sql = "INSERT INTO MESSAGE( MES_ID,RECIEVER_ID,SUBJECT,DESCRIPTION,S_DATE,SENDER_ID )VALUES(  PER_MES_ID_SQ.NEXTVAL,$to,'$sub','$des',SYSDATE,$sid )";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            // $_POST = array();
          } else {
            echo "<div class='alert alert-warning alert-dismissible fade show my-4' role='alert'>
  <strong>Sorry !</strong> Invalid Username.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";

            $_POST = array();
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
  <!-- Summernote -->
  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
</body>

</html>