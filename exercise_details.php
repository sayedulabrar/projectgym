<?php
session_start(); 
$uname = $_SESSION['uname'];
$ex = $_GET['un'];
$designation = null;
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
    $sql = "select * from employee where USERNAME = '$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);    
    if($row == NULL) {
        $designation = 'member';
    }
    else {
        $designation = 'trainer';
    }
    $sql = "select * from exercises_list where exe_id = '$ex'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercise Details</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="  plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="  dist/css/adminlte.min.css">

    

    




</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php
            if($designation == 'member') {
                echo '
                <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="  dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
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
                        <a href="member_profile.php" class="d-block">';
                        echo $uname;
            echo '</a>
                    </div>
                </div>



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
                                    <a href="member_db.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Member</p>
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
                                    <a href="member_profile.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="package.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Packages</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="add_employee.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Add Employee</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href=" examples/Branch.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Branch</p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href=" examples/Search-Manager.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Search Manager</p>
                                    </a>
                                </li> -->




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
                                    <img src="dist/img/enan_pinki.jpg" class="img-circle elevation-2" alt="User Image">
                                </div>
                                <div class="info">
                                    <a href="employee_profile.php?un_=trainer" class="d-block">';
                                        
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
                                                <a href="trainer_db.php" class="nav-link">
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

                                          echo  '<!-- <li class="nav-item">
                                                <a href="pages/mailbox/compose.html" class="nav-link">
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
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 0;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Exercise Info</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="member_db.php">Home</a></li>
                                <li class="breadcrumb-item active">Exercise Info</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->


            <!-- <div class="d-flex justify-content-center">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="  dist/img/user2-160x160.jpg"
                        alt="User profile picture">
                    <h3 class="profile-username text-center">brownfalcon</h3>
                </div>
            </div> -->
            <div class="d-flex justify-content-around mt-3">


                <!-- Profile Image -->


                <div class="col">








                    <ul class="list-group list-group-unbordered mb-3 ">

                        <li class="list-group-item pr-3 pl-3">
                            <b>Exercise ID</b> <a class="float-right">
                            <?php echo $row['EXE_ID']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Exercise Name</b> <a class="float-right"><?php echo $row['EXE_NAME']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Exercise Type</b> <a class="float-right"><?php echo $row['EXE_TYPE']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Minimum Weight</b> <a class="float-right"><?php echo $row['MIN_WEIGHT']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Minimum Height</b> <a class="float-right"><?php echo $row['MIN_HEIGHT']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Minimum Age</b> <a class="float-right"><?php echo $row['MIN_AGE']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Beginner Num of Set</b> <a class="float-right"><?php echo $row['BEG_NUM_OF_SET']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Intermediate Num of Set</b> <a class="float-right"><?php echo $row['INTER_NUM_OF_SET']; ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col">

                    <ul class="list-group list-group-unbordered mb-3">

                        <li class="list-group-item pr-3 pl-3">
                            <b>Advance Num of Set</b> <a class="float-right"><?php echo $row['EXP_NUM_OF_SET']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Beginner Per Set Items</b> <a class="float-right"><?php echo $row['BEG_PER_SET_ITEM']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Intermediate Per Set Items</b> <a class="float-right"><?php echo $row['INTER_PER_SET_ITEM']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Advance Per Set Items</b> <a class="float-right"><?php echo $row['EXP_PER_SET_ITEM']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Beginner Cal Burn Per Set</b> <a class="float-right"><?php echo $row['BEG_CAL_BURN_PER_SET']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Intermediate Cal Burn Per Set</b> <a class="float-right"><?php echo $row['INTER_CAL_BURN_PER_SET']; ?></a>
                        </li>
                        <li class="list-group-item pr-3 pl-3">
                            <b>Advance Cal Burn Per Set</b> <a class="float-right"><?php echo $row['EXP_CAL_BURN_PER_SET']; ?></a>
                        </li>


                    </ul>
                </div>





                <!-- /.card-body -->

                <!-- /.card -->



                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->
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
</body>

</html>