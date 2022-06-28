<?php 
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc

if($_GET == NULL) {
  $uname = $_SESSION['uname'];
}
else {
  $uname = $_GET['un'] ;
}


$showuname = $_SESSION['uname'];
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());

  if (!$conn)
  {
    echo "sorry";
  }

  else
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if (isset($_POST['breakfast_vitamin']) && isset($_POST['breakfast_protein']) &&  isset($_POST['breakfast_carbohydrate']) && isset($_POST['breakfast_minerals']) && isset($_POST['breakfast_fat']) && isset($_POST['breakfast_calory'])  &&   isset($_POST['lunch_vitamin']) && isset($_POST['lunch_protein']) &&  isset($_POST['lunch_carbohydrate']) && isset($_POST['lunch_minerals']) && isset($_POST['lunch_fat']) && isset($_POST['lunch_calory'])  &&   isset($_POST['dinner_vitamin']) && isset($_POST['dinner_protein']) &&  isset($_POST['dinner_carbohydrate']) && isset($_POST['dinner_minerals']) && isset($_POST['dinner_fat']) && isset($_POST['dinner_calory']) &&  isset($_POST['pre_wrk_protein']) &&  isset($_POST['pre_wrk_carbohydrate']) &&  isset($_POST['pre_wrk_calory']) &&  isset($_POST['post_wrk_protein']) &&  isset($_POST['post_wrk_carbohydrate']) &&  isset($_POST['post_wrk_calory']))
      {
        $sql="Select * from Diet_Chart order by Diet_Id desc";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        $diet_id=$row["Diet_Id"]+1;
        $b_vitamin=$_POST['breakfast_vitamin'];
        $b_protein=$_POST['breakfast_protein'];
        $b_carbohydrate=$_POST['breakfast_carbohydrate'];
        $b_minerals=$_POST['breakfast_minerals'];
        $b_fat=$_POST['breakfast_fat'];
        $b_calory=$_POST['breakfast_calory'];

        $l_vitamin=$_POST['lunch_vitamin'];
        $l_protein=$_POST['lunch_protein'];
        $l_carbohydrate=$_POST['lunch_carbohydrate'];
        $l_minerals=$_POST['lunch_minerals'];
        $l_fat=$_POST['lunch_fat '];
        $l_calory=$_POST['lunch_calory'];

        $d_vitamin=$_POST['dinner_vitamin'];
        $d_protein=$_POST['dinner_protein'];
        $d_carbohydrate=$_POST['dinner_carbohydrate'];
        $d_minerals=$_POST['dinner_minerals'];
        $d_fat=$_POST['dinner_fat '];
        $d_calory=$_POST['dinner_calory'];

        $pr_wrk_protein=$_POST['pre_wrk_protein'];
        $pr_wrk_carbohydrte=$_POST['pre_wrk_carbohydrate'];
        $pr_wrk_calory=$_POST['pre_wrk_calory'];

        $po_wrk_protein=$_POST['post_wrk_protein'];
        $po_wrk_carbohydrte=$_POST['post_wrk_carbohydrate'];
        $po_wrk_calory=$_POST['post_wrk_calory'];

        $sql="select * from users where where username = $uname";

        $stid=oci_parse($conn,$sql);
        $r=oci_execute($stid);
        $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
        //$br_name = $roww['BR_NAME'];
        $sql = "insert into diet_chart (DIET_ID,B_VITAMIN,B_FAT,B_PROTEIN,B_MINERALS,B_CARBOHYDRATE,B_CALORIES,
        L_VITAMIN,L_FAT,L_PROTEIN,L_MINERALS,L_CARBOHYDRATE,L_CALORIES,
        D_VITAMIN,D_FAT,D_PROTEIN,D_MINERALS,D_CARBOHYDRATE,D_CALORIES,
        PR_WRK_CARBOHYDRATE,PR_WRK_PROTEIN,PR_WRK_CALORIES,
        PST_WRK_CARBOHYDRATE,PST_WRK_PROTEIN,PST_WRK_CALORIES) values($diet_id, '$b_vitamin', $b_fat, '$b_protein', '$b_minerals','$b_carbohydrate','$b_calory','$l_vitamin', $l_fat, '$l_protein', '$l_minerals','$l_carbohydrate','$l_calory','$d_vitamin', $d_fat, '$d_protein', '$d_minerals','$d_carbohydrate','$d_calory','pr_wrk_protein','pr_wrk_carbohydrate','pr_wrk_calory','po_wrk_protein','po_wrk_carbohydrate','po_wrk_calory')";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $sql = "update member set diet_id=$diet_id where username=$uname";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        
      }
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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
            <a href="employee_profile.php" class="d-block">
              <?php echo $uname ?>
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
                  <?php $diet_id ?>
                </h5>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          

          
            
            

           
              
           
          </div>


         

          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
                <h4 class="d-flex">Breakfast</h4>
  
                <div class="card-tools">
                 
                </div>
              </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
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
                  <tr class="mem_diet">
                    <td>
                        <form>
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="breakfast_vitamin">
                            </div>
                        </form>
                    </td>
                    <td>
                        <form>
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="breakfast_protein">
                            </div>
                        </form>
                    </td>
                    <td>
                        <form>
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="name="breakfast_carbohydrate"">
                            </div>
                        </form>
                    </td> 
                    <td>
                        <form>
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="breakfast_minerals">
                            </div>
                        </form>
                    </td> 

                    <td>
                        <form>
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="breakfast_fat">
                            </div>
                        </form>
                    </td> 
                    <td>
                        <form method="POST">
                            <div class="form-group">
                              <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="breakfast_calory">
                            </div>
                        </form>
                    </td> 
                    
                  </tr>


                  


                 
                 
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->

          </div>

          
        </div>
        <!--/. container-fluid -->
      </section>




      <section class="content">
        <div class="container-fluid">
           
          </div>
          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
              <h4 class="d-flex">Lunch</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
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
                    <tr class="mem_diet">
                        <td>
                            <form>
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_vitamin">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_protein">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_carbohydrate">
                                </div>
                            </form>
                        </td>  
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_minerals">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_fat">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="lunch_calory">
                                </div>
                            </form>
                        </td> 
                        
                      </tr>
    


    
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->


            


          </div>



          
        </div>
        <!--/. container-fluid -->
      </section>



      <section class="content">
        <div class="container-fluid">
           
          </div>
          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
              <h4 class="d-flex">Dinner</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
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
                    <tr class="mem_diet">
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_vitamin">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_protein">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_carbohydrate">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_minerals">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST"> 
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_fat">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="dinner_calory">
                                </div>
                            </form>
                        </td> 
                        
                      </tr>
    


                     
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->


            


          </div>



          
        </div>
        <!--/. container-fluid -->
      </section>




      


      <section class="content">
        <div class="container-fluid">
           
          </div>
          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
              <h4 class="d-flex">Pre Workout</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                    <tr>
                        <th>Protein</th>
                        <th>Carbohydrate</th>
                        <th>Calory</th>
                      </tr>
                </thead>
                <tbody>
                    <tr class="mem_diet">
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="pre_wrk_protein">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="pre_wrk_carbohydrate">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="pre_wrk_calory">
                                </div>
                            </form>
                        </td> 

                        
                      </tr>
    


                     
    

                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->


            


          </div>



          
        </div>
        <!--/. container-fluid -->
      </section>



      <section class="content">
        <div class="container-fluid">
           
          </div>
          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
              <h4 class="d-flex">Post Workout</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                    <tr>
                        <th>Protein</th>
                        <th>Carbohydrate</th>
                        <th>Calory</th>
                      </tr>
                </thead>
                <tbody>
                    <tr class="mem_diet">
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="post_wrk_protein">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="post_wrk_carbohydrate">
                                </div>
                            </form>
                        </td> 
                        <td>
                            <form method="POST">
                                <div class="form-group">
                                  <input type="text" maxlength="5" size="5" class="form-control" id="exampleInputExe1" placeholder="Amount" name="post_wrk_calory">
                                </div>
                            </form>
                        </td> 

                        
                      </tr>
    


                     
                </tbody>
              </table>

            </div>
            <!-- /.table-responsive -->


            


          </div>



          
        </div>
        <!--/. container-fluid -->
      </section>

      

      <div class="container">
        <div class="col-md-12 text-center">
            <a href="#" class="btn btn-success" role="button">Add Diet</a>
            <!-- <a href="trainer.html" class="btn btn-success" role="button">Back</a> -->
        </div>
        
    </div>

           <!-- /.content -->
    <div style="margin-bottom:20px ;"></div>
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
</body>

</html>