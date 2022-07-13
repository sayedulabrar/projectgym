<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc



$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
//   if($_SERVER['REQUEST METHOD']=='POST')
//   {
//     $nme=$_POST[''];
//     $fee=$_POST['ctrl'];
//     $sql = "update Branch set REG_FEE = $fee where BR_NAME=";
//     $stid = oci_parse($conn, $sql);
//     $r = oci_execute($stid);


//   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Fee list</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="      plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="      plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="      dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="      dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Fitness Maina</span>
    </a>
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
            <button onclick="window.location.href=' index.php'" type="button" class="btn btn-secondary">Logout</button>
          </li>
        </ul>
    </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="      dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="admin_profile.html" class="d-block">Alexander Pierce</a>
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
            
          </li>
          
         
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="   pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="   pages/mailbox/compose.html" class="nav-link">
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
                <a href="admin_profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="add_employee.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Add Employee</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="   examples/Branch.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="   examples/Search-Manager.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search Manager</p>
                </a>
              </li>
                -->
              
              
              
            </ul>
          </li>
         
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper" style="margin-top: 0;"> -->
    <!-- Content Header (Page header) -->
    

  











  <!-- Main content -->
  <div class="content-wrapper">
  <section class="content" style="margin-bottom:50px ;">

     <div class="d-flex justify-content-center" style=" padding-top:1%;text-decoration: lightslategray;"><strong>Registration Info</strong></div>

    <div class="card-body"style="margin-top:1%">

        
    <table class="table table-hover table-striped" id='myTable'>
        <thead>
        <tr>
          <th>Branch Name</th>
          <th>Total Ravenue</th>

          <th>Total Cost</th>
          <th>Total Profit</th>
        </tr>
        </thead>
        
        <tbody>
        <?php
         
        $sql = "Select * FROM Branch";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
  
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
          echo
          "
          <tr >
          
          
          <td > <strong><a href=";
          $br_name = $row['BR_NAME'];
          $sql = "select * from users where br_name = '$br_name'";
          $stid1 = oci_parse($conn, $sql);
          $r = oci_execute($stid1);
          $row1 = oci_fetch_array($stid1, OCI_ASSOC + OCI_RETURN_NULLS);
          if($row1 == NULL) {
            echo "#";
          }
          else {
            echo "manager_db.php?un=".$row1['USERNAME'];
          }


          echo ">" . $row['BR_NAME'] . "</a></strong></td>

            <td ><strong>" . $row['BR_REVENUE'] . "</strong></td>
            <td ><strong>" . $row['BR_EXPENDITURE'] . "</strong></td>
            <td ><strong>" . $row['BR_PROFIT'] . "</strong></td>
            
            
            
          </tr> 
          " ;
        }

        ?>
        

        

          
    


        
        
        </tbody>
      </table>
      <!-- /.table -->
    </div>




  </section>
  










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
<script src="      plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="      plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="      dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="      dist/js/demo.js"></script>
<!-- Page specific script -->

</body>
</html>
