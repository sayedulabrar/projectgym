<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc

if ($_GET == NULL) {
  $uname = $_SESSION['uname'];
} else {
  $uname = $_GET['un'];
}

$trainer = $_SESSION['uname'];
$showuname = $_SESSION['uname'];
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());

if (!$conn) {
  echo "sorry";
} else {
  if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $sql1 = "Select Diet_Id from Member where username='$uname'";
  $stid1 = oci_parse($conn, $sql1);
  $r1 = oci_execute($stid1);
  $mem = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
  $sql = "Select * from Diet_Chart order by Diet_Id desc";
  $stid = oci_parse($conn, $sql);
  $r = oci_execute($stid);
  //$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
  $diet_id = 0;

  while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    $diet_id = $diet_id + 1;
  }
  //$diet_id = $row['Diet_Id'];

  if(!isset($mem['diet_id']))
  {
    $diet_id = $diet_id+1;
    $sql5 = "insert into diet_chart (DIET_ID) values('$diet_id')";
    $stid5 = oci_parse($conn,$sql5);
    $r5 = oci_execute($stid5);

    $sql6 = "update Member set Diet_Id = '$diet_id' where username='$uname'";
    $stid6 = oci_parse($conn, $sql6);
    $r6 = oci_execute($stid6,OCI_DEFAULT);
  }

  header("location: diet.php");
  exit;
  

  }



  
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Diet Chart Update</title>

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
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="employee_profile.php" class="d-block">
              <?php echo $trainer ?>
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
                  <a href="employee_profile.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Diet Chart</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
              <h5 class="m-0 float-right">
                <?php


                  if(isset($_POST['submit']))
                  {
                    echo "DIET ID: " . $diet_id;
                  }
                  
                  
                

                ?>
              </h5>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->




      <form action="diet.php" method="post">
        <div class="container">
          <table class="table">
            <h3>Breakfast</h3>
            <thead>

              <tr>
                <th>Vitamin</th>
                <th>Protein</th>
                <th>Carbohydrate</th>
                <th>Minerals</th>
                <th>Fat</th>
                <th>Calory</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_vitamin" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_protein" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_carbohydrate" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_minerals" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_fat" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="breakfast_calory" >

                </td>
              </tr>

            </tbody>
          </table>



          <table class="table">
            <h3>Lunch</h3>
            <thead>

              <tr>
                <th>Vitamin</th>
                <th>Protein</th>
                <th>Carbohydrate</th>
                <th>Minerals</th>
                <th>Fat</th>
                <th>Calory</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_vitamin" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_protein" >

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_minerals">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_fat">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="lunch_calory">

                </td>
              </tr>

            </tbody>
          </table>


          <table class="table">
            <h3>Dinner</h3>
            <thead>

              <tr>
                <th>Vitamin</th>
                <th>Protein</th>
                <th>Carbohydrate</th>
                <th>Minerals</th>
                <th>Fat</th>
                <th>Calory</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_vitamin">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_protein">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_minerals">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_fat">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="dinner_calory">

                </td>
              </tr>

            </tbody>
          </table>


          <table class="table">
            <h3>Pre Workout</h3>
            <thead>

              <tr>
                <th>Protein</th>
                <th>Carbohydrate</th>
                <th>Calory</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="pre_wrk_protein">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="pre_wrk_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="pre_wrk_calory">

                </td>
              </tr>

            </tbody>
          </table>


          <table class="table">
            <h3>Post Workout</h3>
            <thead>

              <tr>
                <th>Protein</th>
                <th>Carbohydrate</th>
                <th>Calory</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="post_wrk_protein">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="post_wrk_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" min="1" max="100" name="post_wrk_calory">

                </td>
              </tr>

            </tbody>
          </table>


        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>


      <?php
      
      

      if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        if (isset($_POST['breakfast_vitamin']) && isset($_POST['breakfast_protein']) &&  isset($_POST['breakfast_carbohydrate']) && isset($_POST['breakfast_minerals']) && isset($_POST['breakfast_fat']) && isset($_POST['breakfast_calory'])  &&   isset($_POST['lunch_vitamin']) && isset($_POST['lunch_protein']) &&  isset($_POST['lunch_carbohydrate']) && isset($_POST['lunch_minerals']) && isset($_POST['lunch_fat']) && isset($_POST['lunch_calory'])  &&   isset($_POST['dinner_vitamin']) && isset($_POST['dinner_protein']) &&  isset($_POST['dinner_carbohydrate']) && isset($_POST['dinner_minerals']) && isset($_POST['dinner_fat']) && isset($_POST['dinner_calory']) &&  isset($_POST['pre_wrk_protein']) &&  isset($_POST['pre_wrk_carbohydrate']) &&  isset($_POST['pre_wrk_calory']) &&  isset($_POST['post_wrk_protein']) &&  isset($_POST['post_wrk_carbohydrate']) &&  isset($_POST['post_wrk_calory'])) {
    
            $b_vitamin = $_POST['breakfast_vitamin'];
            $b_protein = $_POST['breakfast_protein'];
            $b_carbohydrate = $_POST['breakfast_carbohydrate'];
            $b_minerals = $_POST['breakfast_minerals'];
            $b_fat = $_POST['breakfast_fat'];
            $b_calory = $_POST['breakfast_calory'];
    
            $l_vitamin = $_POST['lunch_vitamin'];
            $l_protein = $_POST['lunch_protein'];
            $l_carbohydrate = $_POST['lunch_carbohydrate'];
            $l_minerals = $_POST['lunch_minerals'];
            $l_fat = $_POST['lunch_fat'];
            $l_calory = $_POST['lunch_calory'];
    
            $d_vitamin = $_POST['dinner_vitamin'];
            $d_protein = $_POST['dinner_protein'];
            $d_carbohydrate = $_POST['dinner_carbohydrate'];
            $d_minerals = $_POST['dinner_minerals'];
            $d_fat = $_POST['dinner_fat'];
            $d_calory = $_POST['dinner_calory'];
    
            $pr_wrk_protein = $_POST['pre_wrk_protein'];
            $pr_wrk_carbohydrate = $_POST['pre_wrk_carbohydrate'];
            $pr_wrk_calory = $_POST['pre_wrk_calory'];
    
            $po_wrk_protein = $_POST['post_wrk_protein'];
            $po_wrk_carbohydrate = $_POST['post_wrk_carbohydrate'];
            $po_wrk_calory = $_POST['post_wrk_calory'];
    
    
            $sql = "update Diet_Chart set B_VITAMIN='$b_vitamin',B_PROTEIN='$b_protein',B_CARBOHYDRATE='$b_carbohydrate',B_FAT='$b_fat',B_MINERALS='$b_minerals',B_CALORIES='$b_calory', L_VITAMIN='$l_vitamin',L_PROTEIN='$l_protein',L_CARBOHYDRATE='$l_carbohydrate',L_FAT='$l_fat',L_MINERALS='$l_minerals',L_CALORIES='$l_calory', D_VITAMIN='$d_vitamin',D_PROTEIN='$d_protein',D_CARBOHYDRATE='$d_carbohydrate',D_FAT='$d_fat',D_MINERALS='$d_minerals',D_CALORIES='$d_calory',PR_WRK_CARBOHYDRATE='$pr_wrk_carbohydrate',PR_WRK_PROTEIN='$pr_wrk_protein',PR_WRK_CALORIES='$pr_wrk_calory', PST_WRK_CARBOHYDRATE='$po_wrk_carbohydrate',PST_WRK_PROTEIN='$po_wrk_protein',PST_WRK_CALORIES='$po_wrk_calory' where Diet_Id= '$diet_id' ";
    
    
            $stid2 = oci_parse($conn, $sql);
            $r2 = oci_execute($stid2);
         
          echo "<div class='alert alert-success' role='alert'>This is a success alert—check it out!</div>
          
          ";



          if($r2)  
          {  
            oci_commit($conn);
            echo "Data Updated Successfully !";
          }
          else{
            echo "Error.";
          }


        }
      }
  
  
  
      
      
      
      
      ?>













      <div style="margin-bottom:20px ;"></div>
    </div>



    <aside class="control-sidebar control-sidebar-dark">
    </aside>

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
</body>

</html>