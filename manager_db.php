<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$showname = $_SESSION['uname'];
$designation = $_SESSION['profation'];
$_SESSION['xxx'] = $_SESSION['profation'];
if ($_GET) {
  $uname = $_GET['un'];
} else {
  $uname = $_SESSION['uname'];
}
$_SESSION['designation'] = 'X';
$branchExpenditure = 0;
$branchRevenue = 0;

$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  $sql = "select *from branch natural join users where username = '$uname'";
  $stid = oci_parse($conn, $sql);
  $r = oci_execute($stid);
  $userJoinBranch = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manager Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <button onclick="window.location.href='index.php'" type="button" class="btn btn-secondary">Logout</button>
          </li>
        </ul>
      </div>
    </nav>

    <?php
    if ($designation == 'Manager') {
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
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                  <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
    
                    <li class="nav-item">
                      <a href="manager_db.php" class="nav-link active">
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
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?php
                if ($_GET) {
                  echo "Branch Name: " . $userJoinBranch['BR_NAME'];
                } else {
                  echo "Manager";
                }
                ?>
              </h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">


          <div class="row d-flex justify-content-around">
            <!-- <div class="col-lg-3 col-12" style="background-color: #E74C3C; height: 142px; border-radius: 4px;">
              <div class="bg-danger" style="font-size: 16px; padding-left: 3px; padding-top: 10px;">
                <div class="inner">
                  <h3 style="font-size: 35px;"><b>1500 tk</b></h3>

                  <p style="padding-top: 15px;">Registration Fee</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div> -->
            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?php echo $userJoinBranch["REG_FEE"] ?>
                  </h3>

                  <p>Registration Fee</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from users natural join member where br_name in('$br_name')";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Member</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="member_list.php<?php
                                        if ($_GET) {
                                          echo "?un=" . $_GET['un'];
                                        }
                                        ?>
                " class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from users natural join employee where br_name in('$br_name') and designation = 'Trainer'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Trainer</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="trainer_list.php<?php
                                          if ($_GET) {
                                            echo "?un=" . $_GET['un'];
                                          }
                                          ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from users natural join employee where br_name in('$br_name') and designation = 'Receptionist'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Receiptionist</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="receptionist_list.php<?php
                                              if ($_GET) {
                                                echo "?un=" . $_GET['un'];
                                              }
                                              ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from equipment where br_name in('$br_name')";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>

                  </h3>

                  <p>Equipments Type</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="equipments_list.php<?php
                                            if ($_GET) {
                                              echo "?un=" . $_GET['un'];
                                            }
                                            ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from br_pkg where br_name in('$br_name')";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Packages</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="packages_list.php<?php
                                          if ($_GET) {
                                            echo "?un=" . $_GET['un'];
                                          }
                                          ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from expenditure where br_name in('$br_name')";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Expenditure</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="expenditure_list.php<?php
                                              if ($_GET) {
                                                echo "?un=" . $_GET['un'];
                                              }
                                              ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php
                    $br_name = $userJoinBranch["BR_NAME"];
                    $sql = "select *from income where br_name in('$br_name')";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);

                    $num = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    echo $num;

                    ?>
                  </h3>

                  <p>Revenue</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="revenue_list.php<?php
                                          if ($_GET) {
                                            echo "?un=" . $_GET['un'];
                                          }
                                          ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Monthly Recap Report</h5>


                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4 col-8">
                      <div class="description-block border-right">
                        <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> -->
                        <h5 class="description-header">
                          <?php
                          $sql="select EXTRACT(MONTH FROM SYSDATE)-1 AS KP  from dual";
                          $stid = oci_parse($conn, $sql);
                          $r = oci_execute($stid);
                          $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

                           $ddt = $row['KP'];
                           $ddt2=$ddt-1;

                          $sql="select  SUM(INC_AMOUNT) from income WHERE EXTRACT(MONTH FROM INC_DATEANDTIME)=(select EXTRACT(MONTH FROM SYSDATE)-1  from dual) AND BR_NAME='$br_name'";
                          $stid = oci_parse($conn, $sql);
                          $r = oci_execute($stid);
                          $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

                          
                           $ans = $row['SUM(INC_AMOUNT)'];
                          





                          $curs = oci_new_cursor($conn);
                          $stid = oci_parse($conn, "begin myproc2(:cursbv); end;");
                          oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
                          oci_execute($stid);
                          
                          oci_execute($curs);  // Execute the REF CURSOR like a normal statement id
                          $f_month2=0;
                          $s_month2=0;
                          while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                              

                              if($row['DT']==$ddt && $row['BR_NAME']==$br_name)
                              {
                                $f_month2=$f_month2+$row['INC_AMOUNT'];

                              }else if($row['DT']==$ddt2 && $row['BR_NAME']==$br_name)
                              {
                                $s_month2=$s_month2+$row['INC_AMOUNT'];
                              }

                              
                          }
                          

                          oci_free_statement($stid);
                          oci_free_statement($curs);


                          $bn1=  $f_month2 ;
                          $bn2=  $s_month2 ;
                          if($bn1!=0)
                          {
                            $bn3=round(($bn1-$bn2)/$bn1,2)*100 ;

                            echo"<p class='text-success'>".$bn3."%</p> ";
                          }else
                          {
                            echo"<p class='text-success'>Revenue of last month doesn't exist</p> ";
                          }


                          echo $ans . " BDT";



                          
                          
                  
                          ?>
                        </h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-8">
                      <div class="description-block border-right">
                        <h5 class="description-header">
                        <?php

$sql=" select  SUM(AMOUNT) from expenditure WHERE EXTRACT(MONTH FROM EXP_DATEANDTIME)=(select EXTRACT(MONTH FROM SYSDATE)-1  from dual) AND BR_NAME='$br_name'";
$stid = oci_parse($conn, $sql);
$r = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);


$ans2 = $row['SUM(AMOUNT)'];


$curs = oci_new_cursor($conn);
$stid = oci_parse($conn, "begin myproc(:cursbv); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);

oci_execute($curs);  // Execute the REF CURSOR like a normal statement id
$f_month=0;
$s_month=0;
while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
   

   if($row['DT']==$ddt && $row['BR_NAME']==$br_name)
   {
     $f_month=$f_month+$row['AMOUNT'];

   }else if ($row['DT']==$ddt2 && $row['BR_NAME']==$br_name)
   {
     $s_month=$s_month+$row['AMOUNT'];
   }

   
}



oci_free_statement($stid);
oci_free_statement($curs);
$bn1= $f_month2 - $f_month ;
$bn2= $s_month2 - $s_month ;

if($bn1!=0)
                          {
                            $bn3=round(($bn1-$bn2)/$bn1,2)*100 ;

                            echo"<p class='text-success'>".$bn3."%</p> ";
                          }else
                          {
                            echo"<p class='text-success'>Expendeture of last month doesn't exist</p> ";
                          }

echo $ans2 . " BDT";
?>
                        </h5>
                        <span class="description-text">BRANCH EXPENDITURE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-8">
                      <div class="description-block border-right">
                        <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> -->
                        <h5 class="description-header">
                          <?php
                          $bn1= $f_month2 - $f_month ;
                          $bn2= $s_month2 - $s_month ;

                          if($bn1!=0)
                          {
                            $bn3=round(($bn1-$bn2)/$bn1,2)*100 ;

                            echo"<p class='text-success'>".$bn3."%</p> ";
                          }else
                          {
                            echo"<p class='text-success'>Profit of last month doesn't exist</p> ";
                          }
                          

                       echo $ans - $ans2 . " BDT";
                          ?>
                        </h5>
                        <span class="description-text">BRANCH PROFIT</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!--/. container-fluid -->
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
    <footer class="main-footer">
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
</body>

</html>