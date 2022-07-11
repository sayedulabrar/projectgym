<?php

session_start();

if ($_GET == NULL) {
  $uname = $_SESSION['uname'];
  
  //$va1=$uname;
} else {
  $uname = $_GET['un'];
  
  //$va2=$uname;
}

$username = $_SESSION['uname'];


?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inbox</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="admin_db.html" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item float-right">
        <button  type="button" class="btn btn-primary">Logout</button>
      </li>

      
      
    </ul>
  </nav>
  <!-- /.navbar -->
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
          <?php echo "<a href='../../admin_profile.html' class='d-block'>".$username."</a>"; ?>
        </div>
      </div>

     

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="../../admin_db.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
                <ul class="nav nav-treeview">
  
                  <li class="nav-item">
                    <a href="../../admin_db.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dashboard v2</p>
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
                    <a href="../mailbox/mailbox.html" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inbox</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../mailbox/compose.html" class="nav-link">
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
                    <a href="../examples/profilev2.html" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Profile</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../examples/userreg.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Manager Add</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../examples/Branch.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Branch</p>
                    </a>
                  </li>
  
  
                  <li class="nav-item">
                    <a href="../examples/Search-Manager.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Search Manager</p>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-top: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inbox</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../admin_db.php">Home</a></li>
              <li class="breadcrumb-item active">Inbox</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  











  <!-- Main content -->
  <section class="content" style="margin-bottom:50px ;">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Sender Name</label>
              <input type="text" id="inputName" class="form-control">
            </div>

            <div class="form-group">
              <label for="inputName">Sender Id</label>
              <input type="text" id="inputName" class="form-control">
            </div>
            
            
            <div class="form-group">
              <label>Sort Order:</label>
              <select class="select2" style="width: 100%;">
                  <option selected>ASC</option>
                  <option>DESC</option>
              </select>
            </div>

            <div class="form-group">
              <label for="inputClientCompany">Branch Name</label>
              <input type="text" id="inputClientCompany" class="form-control">
            </div>

            <div class="form-group">
              <label for="inputClientCompany">Designation</label>
              <input type="text" id="inputClientCompany" class="form-control">
            </div>

            

            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      
    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Search" class="btn btn-success float-right">
      </div>
    </div>



    <div class="table-responsive mailbox-messages"style="margin-top:2%">
      <table class="table table-hover table-striped">
        <tbody>
        <tr>
          
          <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
          <td class="mailbox-name"><a href="read-mail.html">From :  Shafin Pierce</a></td>
          <td class="mailbox-subject"><b>Alexender's Issue</b> - Trying to find a solution to this problem...
          </td>
          <td class="mailbox-attachment"></td>
          <td class="mailbox-date">5 mins ago</td>
        </tr>


        <tr>
          
          <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
          <td class="mailbox-name"><a href="read-mail.html">From :  Rayan Pierce</a></td>
          <td class="mailbox-subject"><b>Alexender's Issue</b> - New course available for...
          </td>
          <td class="mailbox-attachment"></td>
          <td class="mailbox-date">1 hours ago</td>
        </tr>
        
        </tbody>
      </table>
      <!-- /.table -->
    </div>




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
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>
</body>
</html>
