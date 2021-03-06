<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$_SESSION['routine'] = NULL;
$uname = $_SESSION['uname'];
$designation = $_SESSION['profation'];
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
    or die(oci_error());
if (!$conn) {
    echo "Sorry";
} else {
    $sql = "select * from employee where username = '$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $tra = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trainer | Dashboard </title>

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

<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <a href=" index.php" type="button" class="btn btn-secondary">Logout</a>
                    </li>
                </ul>
            </div>

            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->

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
                        <a href="employee_profile.php" class="d-block">
                            <?php
                            echo $uname;
                            ?>
                        </a>
                    </div>
                </div>

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
                                    <a href="trainer_db.php" class="nav-link active">
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
                            <ul class="nav nav-treeview">
                                <?php
                                echo "<li class='nav-item'>

                                
                                    
                                         <a href='pages/mailbox/mailbox.php?un=" . $uname . "' class='nav-link'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Inbox</p>
                                         </a>

                                   
                                </li>";
                                ?>


                                <?php
                                echo "<li class='nav-item'>                    
                                <a href='pages/mailbox/compose.php?un=" . $uname . "' class='nav-link'>
                                <i class='far fa-circle nav-icon'></i>
                                <p>Compose</p>
                                </a>
                                </li>";
                                ?>

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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Trainer</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <section class="content">
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        //$br_name = $member_number["TRAINER"];
                                        $sql = "select * from  MEMBER_VIEW where ASSIGNED_TRAINER = '$uname'";
                                        $stid = oci_parse($conn, $sql);
                                        $r = oci_execute($stid);

                                        $num = 0;
                                        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                            $num = $num + 1;
                                        }
                                        echo $num;
                                        ?>
                                    </h3>

                                    <p>Members</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>
                                        <?php

                                        $sql = "select * from MEMBER_VIEW where ASSIGNED_TRAINER='$uname'";
                                        $stid = oci_parse($conn, $sql);
                                        $r = oci_execute($stid);

                                        $s = 0;
                                        $cnt = 0;
                                        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {

                                            if ($row["TRAINER_RATING"] <> NULL) {
                                                $s = $s + $row["TRAINER_RATING"];
                                                $cnt = $cnt + 1;
                                            }
                                        }
                                        if ($cnt == 0) {
                                            echo "0";
                                        } else {
                                            echo number_format($s / $cnt, 2);
                                        }


                                        ?>

                                    </h3>

                                    <p>Rating</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
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
                                        echo $tra["SALARY"] . " BDT";
                                        ?>

                                    </h3>

                                    <p>Salary</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        if ($tra["SHIFT"] == 1) {
                                            echo "Morning";
                                        } else {
                                            echo "Evening";
                                        }
                                        ?>
                                    </h3>

                                    <p>Shift</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas"></i></a>
                            </div>
                        </div>

                    </div>





                    <div class="card">
                        <div class="card-header border-transparent" id="assigned_members">
                            <h1 class="d-flex justify-content-center">Assigned Members</h1>
                            <div class="card-tools">
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id='myTable'>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>BMI</th>
                                            <th>Age</th>
                                            <th>Diet Chart</th>
                                            <th>Action</th>
                                            <th>Exercise Routine</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "select * from MEMBER_VIEW where ASSIGNED_TRAINER='$uname'";
                                        $stid = oci_parse($conn, $sql);
                                        $r = oci_execute($stid);

                                        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                            $un = $row["MEMBER_USERNAME"];
                                            $dateOfBirth = $row["DATE_OF_BIRTH"];
                                            $name1 = $row["MEMBER_NAME"];
                                            $sql1 = 'BEGIN :var :=AGE(:daofbi); END;';
                                            $stid1 = oci_parse($conn, $sql1);
                                            oci_bind_by_name($stid1, ':daofbi', $dateOfBirth);
                                            oci_bind_by_name($stid1, ':var', $age);
                                            $r1 = oci_execute($stid1);
                                            $var = $row["ASSIGNED_DIET_ID"];
                                            // $sql1 = "Select * from Member where username='$un'";
                                            // $stid1 = oci_parse($conn, $sql1);
                                            // $r1 = oci_execute($stid1);
                                            // $mem = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
                                            $val = number_format(($row["MEMBER_WEIGHT"] * 2.21 * 703) / ($row["MEMBER_HEIGHT"] * 0.39 * $row["MEMBER_HEIGHT"] * 0.39), 3);
                                            // $val = $row["MEMB_BMI"];
                                            $query = "update Member set Memb_BMI='$val' where username='$un'";
                                            $p = oci_parse($conn, $query);
                                            $setting = oci_execute($p);
                                            echo "
                                                 <tr class='tr_as_mem'>
                                                   <th scope='row'><a href='member_profile.php?un=" . $un . "'>" . $row["MEMBER_NAME"] . "</a></th>                                                  
                                                   <td>" . $val . "</td>
                                                   <td>" . $age . "</td>
                                                  
                                                   <td>";
                                            if ($row["ASSIGNED_DIET_ID"]) {
                                                echo "Set";
                                            } else {
                                                echo "Not set yet";
                                            }
                                            echo "</td><td>";
                                            echo "&nbsp; &nbsp;<a href='diet.php?un=" . $un . "' class='btn btn-success' role='button'>Add/Edit</a></td>
                                                   <td>";
                                            $sql1 = "Select * from Routine where username='$un'";
                                            $stid1 = oci_parse($conn, $sql1);
                                            $r1 = oci_execute($stid1);
                                            $mem = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
                                            if ($mem) {
                                                echo "Set";
                                            } else {
                                                echo "Not set yet";
                                            }
                                            echo "</td><td>";
                                            echo "&nbsp; &nbsp;<a href='routine.php?un=" . $un . "' class='btn btn-success'
                                                     role='button'>Add/Edit</a></td>
                                                 </tr>
                                                ";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>


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
            <strong>Copyright &copy; 2022 <a href="#">Gym Management System</a>.</strong>
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