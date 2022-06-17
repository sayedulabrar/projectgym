<?php
  session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
  $uname = $_SESSION['uname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trainer | Dashboard </title>

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
      <a href="$" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
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
            <a href="employee_profile.html" class="d-block">Boyati Enan</a>
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
                  <a href="employee_profile.html" class="nav-link">
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
              <h1 class="m-0">Trainer</h1>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          

          <div class="row">
            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>Members</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-12">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>4.5</h3>

                  <p>Rating</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>12,000 BDT</h3>
  
                    <p>Salary</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-12">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>8.00 am</h3>
  
                    <p>Shift</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>
           
          </div>


        


          <div class="card" >
            <div class="card-header border-transparent"  id="assigned_members">
              <h1 class="d-flex justify-content-center">Assigned Members</h1>

              <div class="card-tools">
                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button> -->
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>BMI</th>
                    <th>Age</th>
                    <th>Diet_Id</th>
                    <th>Routine_Id</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="tr_as_mem">
                    <td><a href=" member_profile.html">Abrar Faiyaz Khan</a></td>
                    <td>17.8</td>
                    <td>22</td> 
                    <td>NULL &nbsp; &nbsp;<a href="diet.html" class="btn btn-success" role="button">Update</a></td>
                    <td>NULL  &nbsp; &nbsp;<a href="routine.html" class="btn btn-success" role="button">Update</a></td>
                    
                    

                    
                  </tr>
                  <tr class="tr_as_mem">
                    <td><a href="member_profile.html">Arnab Sircar</a></td>
                    <td>18.4</td>
                    <td>21</td> 
                    <td>NULL &nbsp; &nbsp;<a href="diet.html" class="btn btn-success" role="button">Update</a></td>
                    <td>NULL &nbsp; &nbsp;<a href="routine.html" class="btn btn-success" role="button">Update</a></td>
                    
                    
                  </tr>
                  <tr class="tr_as_mem">
                    <td><a href=" member_profile.html">Mohiuddin Bilwal Ayon</a></td>
                    <td>20.6</td>
                    <td>22</td> 
                    <td>NULL &nbsp; &nbsp;<a href="diet.html" class="btn btn-success" role="button">Update</a></td>
                    <td>NULL &nbsp; &nbsp;<a href="routine.html" class="btn btn-success" role="button">Update</a></td>
                   
                   
                  </tr>
                  <tr class="tr_as_mem">
                    <td><a href=" member_profile.html">Sayedul Abrar</a></td>
                    <td>20.2</td>
                    <td>22</td> 
                    <td>NULL &nbsp; &nbsp;<a href="diet.html" class="btn btn-success" role="button">Update</a></td>
                    <td>NULL &nbsp; &nbsp;<a href="routine.html" class="btn btn-success" role="button">Update</a></td>
                    

                  </tr>
                  <tr class="tr_as_mem">
                    <td><a href=" member_profile.html">Saifur Rahman</a></td>
                    <td>23.6</td>
                    <td>23</td> 
                    <td>NULL &nbsp; &nbsp;<a href="diet.html" class="btn btn-success" role="button">Update</a></td>
                    <td>NULL &nbsp; &nbsp;<a href="routine.html" class="btn btn-success" role="button">Update</a></td>
                   
                  </tr>
                 
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
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
</body>

</html>