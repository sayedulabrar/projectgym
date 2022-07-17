<?php
  session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
  $_SESSION['profation']="trainer";
  if ($_GET == NULL) {
    $uname = $_SESSION['uname'];
    
    //$va1=$uname;
  } else {
    $uname = $_GET['un'];
    $_SESSION['extra'] = $uname;
    //$va2=$uname;
  }
  //$uname = $_GET['un'];

  
  $trainer = $_SESSION['uname'];
  

  $conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
    or die(oci_error());

    if (!$conn) {
      echo "sorry";
    } 

    else{
      
      $sql1 = "Select * from Member where username='$uname'";
      $stid1 = oci_parse($conn, $sql1);
      $r1 = oci_execute($stid1);
      $mem = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
      $diet_id=0;
    
   


    //header("location: diet.php?un=$uname");
      
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
            <a href="employee_profile.php?un_=trainer" class="d-block">
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
              <?php
                  echo "<li class='nav-item'>                    
                  <a href='pages/mailbox/mailbox.php?un=".$trainer."' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Inbox</p>
                  </a>
</li>";
              ?>


              <?php
                  echo "<li class='nav-item'>                    
                  <a href='pages/mailbox/compose.php?un=".$trainer."' class='nav-link'>
                  <i class='far fa-circle nav-icon'></i>
                  <p>Compose</p>
                  </a>
                  </li>";
              ?>
                <!-- <li class="nav-item">
                  <a href="pages/mailbox/compose.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li> -->

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


                  if($mem['DIET_ID'] == NULL)
                  {
                    echo "DIET ID: Null" ;
                  }
                  else
                  {
                    
                    
                    //else{
                      echo "DIET ID: ".$mem['DIET_ID'];
                    //}
                  }
                  
                  
                

                ?>
              </h5>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <?php
        if($mem['DIET_ID'] == NULL) {
          $row = NULL;
        }
        else {
          $sql = "select * from diet_chart where diet_id = $mem[DIET_ID]";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        }
      ?>

      <form action="diet_extra.php" method="post">
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
                  <input class="form-control" type="number" value = "<?php  
                    if(isset($row['B_VITAMIN'])) echo $row['B_VITAMIN'];
                    else echo "0"; 
                   ?>" name="breakfast_vitamin" >
                  
                </td>
                <td>
                  <input class="form-control" type="number"  value = "<?php  
                    if(isset($row['B_PROTEIN'])) echo $row['B_PROTEIN'];
                    else echo "0"; 
                   ?>" name="breakfast_protein" >

                </td>
                <td>
                  <input class="form-control" type="number"  value = "<?php  
                    if(isset($row['B_CARBOHYDRATE'])) echo $row['B_CARBOHYDRATE'];
                    else echo "0"; 
                   ?>" name="breakfast_carbohydrate" >

                 
                </td>
                <td>
                  <input class="form-control" type="number"  value = "<?php  
                    if(isset($row['B_MINERALS'])) echo $row['B_MINERALS'];
                    else echo "0"; 
                   ?>" 
                  
                  name="breakfast_minerals" >
                  
                </td>
                <td>
                  <input class="form-control" type="number" value = "<?php  
                    if(isset($row['B_FAT'])) echo $row['B_FAT'];
                    else echo "0"; 
                   ?>" name="breakfast_fat" >

                </td>
                <td>
                  <input class="form-control" type="number" value = "<?php  
                    if(isset($row['B_CALORIES'])) echo $row['B_CALORIES'];
                    else echo "0"; 
                   ?>" name="breakfast_calory" >

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
                  <input class="form-control" type="number"
                  value = "<?php  
                    if(isset($row['L_VITAMIN'])) echo $row['L_VITAMIN'];
                    else echo "0"; 
                   ?>" name="lunch_vitamin" >

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['L_PROTEIN'])) echo $row['L_PROTEIN'];
                    else echo "0"; 
                   ?>" name="lunch_protein" >

                </td>
                <td>
                  <input class="form-control" type="number" value = "<?php  
                    if(isset($row['L_CARBOHYDRATE'])) echo $row['L_CARBOHYDRATE'];
                    else echo "0"; 
                   ?>" name="lunch_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['L_MINERALS'])) echo $row['L_MINERALS'];
                    else echo "0"; 
                   ?>"  name="lunch_minerals">

                </td>
                <td>
                  <input class="form-control" type="number" value = "<?php  
                    if(isset($row['L_FAT'])) echo $row['L_FAT'];
                    else echo "0"; 
                   ?>" name="lunch_fat">
                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['L_CALORIES'])) echo $row['L_CALORIES'];
                    else echo "0"; 
                   ?>"
                   name="lunch_calory">
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
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['D_VITAMIN'])) echo $row['D_VITAMIN'];
                    else echo "0"; 
                   ?>" name="dinner_vitamin">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['L_PROTEIN'])) echo $row['L_PROTEIN'];
                    else echo "0"; 
                   ?>"
                  name="dinner_protein">

                </td>
                <td>
                  <input class="form-control" type="number"
                  value = "<?php  
                    if(isset($row['D_CARBOHYDRATE'])) echo $row['D_CARBOHYDRATE'];
                    else echo "0"; 
                   ?>"  name="dinner_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['D_MINERALS'])) echo $row['D_MINERALS'];
                    else echo "0"; 
                   ?>" name="dinner_minerals">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['D_FAT'])) echo $row['D_FAT'];
                    else echo "0"; 
                   ?>" name="dinner_fat">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['D_CALORIES'])) echo $row['D_CALORIES'];
                    else echo "0"; 
                   ?>"
                  name="dinner_calory">

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
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PR_WRK_PROTEIN'])) echo $row['PR_WRK_PROTEIN'];
                    else echo "0"; 
                   ?>" name="pre_wrk_protein">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PR_WRK_CARBOHYDRATE'])) echo $row['PR_WRK_CARBOHYDRATE'];
                    else echo "0"; 
                   ?>" name="pre_wrk_carbohydrate">



                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PR_WRK_CALORIES'])) echo $row['PR_WRK_CALORIES'];
                    else echo "0"; 
                   ?>"
                  name="pre_wrk_calory">



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
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PST_WRK_PROTEIN'])) echo $row['PST_WRK_PROTEIN'];
                    else echo "0"; 
                   ?>"
                  
                  name="post_wrk_protein">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PST_WRK_CARBOHYDRATE'])) echo $row['PST_WRK_CARBOHYDRATE'];
                    else echo "0"; 
                   ?>"
                  name="post_wrk_carbohydrate">

                </td>
                <td>
                  <input class="form-control" type="number" 
                  value = "<?php  
                    if(isset($row['PST_WRK_CALORIES'])) echo $row['PST_WRK_CALORIES'];
                    else echo "0"; 
                   ?>"
                  name="post_wrk_calory">

                </td>
              </tr>

            </tbody>
          </table>


        </div>

        <div class="text-center">
          <button type="submit" id="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>


      
      
      

    










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

  <script src="dist/js/sweetalert.min.js"></script>

  <?php

        echo "<script>
        

      
        $('#submit').click(function(){

          swal({
            title: 'Good job!',
            text: 'Your data has been updated successfully!',
            icon: 'success',
            button: 'Cancel',
            timer: 6000,
          });
         
        });
        
        
        
        </script>";
          


          


      ?>

  
</body>

</html>