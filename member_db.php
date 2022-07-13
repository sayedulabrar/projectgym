<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$designation=$_SESSION['profation'];
$conn = oci_connect('brownfalcon_gms2', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if(!$conn)
{
  echo "Sorry";
}
else
{
  // echo "Connection Successful";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Member Dashboard</title>

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
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

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
            <a href="member_profile.php" class="d-block">
              <?php
                $sql = "select name from users where username='$uname'";
                $stid = oci_parse($conn, $sql);
                $r = oci_execute($stid);
                $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                echo $row['NAME'];
              ?>
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
                  <a href="member_db.php" class="nav-link active">
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

                </li>
                <li class="nav-item">
                  <a href="member_profile.php" class="nav-link">
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
                </li>
                <li class="nav-item">
                  <a href="add_member.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Add Member</p>
                  </a>
                </li> -->
                <!-- <li class="nav-item">
                  <a href="pages/examples/Branch.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Branch</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/Search-Manager.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Search Manager</p>
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Member</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">


          <div class="row d-flex justify-content-around">
            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>


                  </h3>
                  <?php
                  $sql = "select mem_weight from member where username='$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    
                    echo $row['MEM_WEIGHT']."kg";
                    
                   
                  ?>
                  <p>Weight</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <p style="font-size: 20px; padding: 0px;margin: 0px;"><b style="font-size: 32px;padding-right: 40px;">
                  <?php
                  $sql = "select trainer from member where username='$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    
                    $tr_name=$row['TRAINER'];
                    $sql = "select name from users where username='$tr_name'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    echo $row['NAME'] ;
                    
                   
                    ?>
                
                </b> -trainer</p>
                  <input type="text" class="form-control" placeholder="Rate out of 5" aria-label="Username" aria-describedby="basic-addon1">
                  <button type="button" class="btn btn-primary">Rate</button>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">Rate Trainer <i class="fas fa-arrow-circle-right"></i></a> -->
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>
                  <?php
                  $sql = "select MEMBERSHIP_EXPIRY from member where username='$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    
                    echo $row['MEMBERSHIP_EXPIRY'];
                    
                   
                    ?>

                  </h3>

                  <p>Expiry Date</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="receptionist_list.php" class="small-box-footer"><i class="fas"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                  <?php
                  $sql = "select mem_weight from member where username='$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    
                    $weight=$row['MEM_WEIGHT'];

                    $sql = "select mem_height from member where username='$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    $height=$row['MEM_HEIGHT'];
                    

                    $height=$height/100;
                    
                    $height=$height**2;
                   
                    $bmi=number_format($weight/$height,2);
                
                    echo $bmi;

                    $query = "update Member set Memb_BMI='$bmi' where username='$uname'";
                    $p=oci_parse($conn,$query);
                    $setting=oci_execute($p);


                    ?>

                  </h3>

                  <p>BMI</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer"><i class="fas"></i></a>
              </div>
            </div>

          </div>


          <div class="card">
            <div class="card-header border-transparent" id="diet_heading">
              <h1 class="d-flex justify-content-center">Diet Chart</h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Vitamin</th>
                      <th>Fat</th>
                      <th>Protein</th>
                      <th>Mineral</th>
                      <th>Carbohydrate</th>
                      <th>Calories</th>


                    </tr>
                  </thead>
                  <tbody>
                    <tr class="breakfast">
                      <td>Breakfat</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>10</td>



                    </tr>
                    <tr class="lunch">
                      <td>Lunch</a></td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>10</td>

                    </tr>
                    <tr class="dinner">
                      <td>Dinner</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>10</td>

                    </tr>
                    <tr class="preworkout">
                      <td>Preworkout</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>10</td>

                    </tr>
                    <tr class="postworkout">
                      <td>Postworkout</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>1g</td>
                      <td>10</td>

                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
          </div>
          <h1 style="text-align: center;">Routine</h1>
          <div class="card">
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Saturday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Sunday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Monday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Tuesday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Wednesday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Thursday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

            </div>


            <!-- </div> -->

            <!-- <div class="card" > -->
            <div class="card-header border-transparent" id="day_exe">
              <h4 class="d-flex">Friday</h4>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Exercise Id</th>
                      <th>Exercise Name</th>
                      <th>Exercise Type</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>
                  <tbody>
                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>

                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Fitness
                      </td>
                      <!-- <td>
                      <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                    </td>
                       -->
                    </tr>


                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Body Building
                      </td>
                      <!-- <td>
                        <a href="routine.html" class="btn btn-success" role="button">Delete</a>
                      </td> -->
                    </tr>

                    <tr class="mem_routine">
                      <td>
                        <a href="exercise_details.html">E_001</a>
                      </td>
                      <td>
                        Push Up
                      </td>
                      <td>
                        Jumping
                      </td>

                    </tr>






                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

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