<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$showname = $_SESSION['uname'];
$designation = $_SESSION['profation'];
$donewithin = false;
$history = false;
$costl = false;
$costg = false;
$company = false;
if ($_GET != NULL && ($_GET['un'] != 'u' && $_GET['un'] != 'i' && $_GET['un'] != 'd' && $_GET['un'] != 'w')) {
  $uname = $_GET['un'];
} else {
  $uname = $_SESSION['uname'];
}

$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if (isset($_POST['name']) && isset($_POST['quantity'])) {
    $sql = "select *from equipment order by equipment_id desc";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $trx_id = $row['EQUIPMENT_ID'] + 1;
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $sql = "select *from users where username='$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $roww = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $br_name = $roww['BR_NAME'];
    $sql = "insert into equipment (equipment_id, equipment_name, equipment_quantity, equipment_available, equipment_brand, equipment_model, br_name) values($trx_id, '$name', $quantity, '0', '$brand', '$model','$br_name')";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);

    header("Location: equipments_list.php?un=i");
  }
  if (isset($_POST['equip_id'])) {
    $equip_id = $_POST['equip_id'];
    $_SESSION['xxx'] = $equip_id;
    $sql = "update maintenance set cur = '0' where EQUIPMENT_ID = $equip_id" ;
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);

    header("Location: maintenance_list.php?un=d");
  }
  if (isset($_POST['equip_id2'])) {
    $equip_id = $_POST['equip_id2'];
    $quantity = $_POST['quantity1'];
    $sql = "update equipment set equipment_quantity = $quantity where equipment_id = $equip_id";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);

    header("Location: equipments_list.php?un=u");
  }
  if(isset($_POST['dw'])) {
    $dw = $_POST['dw'];
    $donewithin = true;
  }
  if(isset($_POST['hp'])) {
    $hp = $_POST['hp'];
    $history = true;
    // $_SESSION['xxx'] = $_POST['hp'];
  }
  if(isset($_POST['em'])) {
    $em = $_POST['em'];
    $costg = true;
  }
  if(isset($_POST['el'])) {
    $el = $_POST['el'];
    $costl = true;
  }
  if(isset($_POST['un'])) {
    $un = $_POST['un'];
    $company = true;
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Equipments List</title>

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

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <button onclick="window.location.href=' index.php'" type="button" class="btn btn-secondary">Logout</button>
          </li>
        </ul>
      </div>
    </nav>



    <!-- /.navbar -->

    <?php
    if($designation == "receptionist") {
      echo '
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
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
              <a href="employee_profile.php?un_=receptionist" class="d-block">'.
              $uname
              .'</a>
            </div>
          </div>
  
          
  
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             
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
                    <a href="receptionist.php" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Receptionist</p>
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
  
            echo    ' </ul>
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
    else {
    if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
      echo '
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
                            <a href="manager_db.php" class="nav-link">
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
                <a href="employee_profile2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              
               
              
               <li class="nav-item">
                <a href="pages/examples/userreg.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member Add</p>
                </a>
              
              
              <li class="nav-item">
                <a href="pages/examples/Search-Manager.php" class="nav-link">
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
          
  ';
    }
  }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content" style="margin-bottom:50px ;">

      <?php
        if ($_GET) {
          if ($_GET['un'] == 'i') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Successfully inserted
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          } elseif ($_GET['un'] == 'u') {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Successfully Updated
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          } elseif ($_GET['un'] == 'd') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Maintenance Done
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
        }
        ?>
        <div class="container-fluid">
          <!-- <form action="Manager-results.html"> -->
          <div class="row">
              
            <div class="col-md-12">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Search Using</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                              title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="bg-light clearfix">
                    
                    <br>
                    <div class="container" >
              <div class="row">
                
                <div class="form-group col-lg-5 col-12">
                  
                  <div class="row">
                    <div class="form-group col-lg-6 col-12">
                      <h5 style="text-align: center;">Done Within</h5>
                       <br>
                      <form action="maintenance_list.php" method = "POST">
                        <div class="row">
                          <div class="form-group col-lg-7 col-12">
                            <input type="number" placeholder="Days" class="form-control" id="dw" name="dw">
                          </div>
                          <div class="form-group col-lg-5 col-12">
                            <button type="submit" class="btn btn-secondary">Search</button>
                            
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="form-group col-lg-6 col-12">
                    <h5 style="text-align: center;">History of Previous</h5>
                     <br>
                      <form action="maintenance_list.php" method = "POST">
                        <div class="row">
                          <div class="form-group col-lg-7 col-12">
                            <input type="number" placeholder="Days" class="form-control" id="hp" name="hp">
                          </div>
                          <div class="form-group col-lg-5 col-12">
                            <button type="submit" class="btn btn-secondary">Search</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                </div>
                <div class="form-group col-lg-5 col-12">
                  <h5 style="text-align: center;">Cost</h5>
                  <br>
                  <div class="row">
                  
                    <div class="form-group col-lg-6 col-12">
                      
                      <form action="maintenance_list.php" method = "POST">
                        <div class="row">
                          <div class="form-group col-lg-7 col-12">
                            <input type="number" placeholder="Equal or less" class="form-control" id="el" name="el">
                          </div>
                          <div class="form-group col-lg-5 col-12">
                            <button type="submit" class="btn btn-secondary">Search</button>
                            
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="form-group col-lg-6 col-12">
                      <form action="maintenance_list.php" method = "POST">
                        <div class="row">
                          <div class="form-group col-lg-7 col-12">
                            <input type="number" placeholder="Equal or More" class="form-control" id="em" name="em">
                          </div>
                          <div class="form-group col-lg-5 col-12">
                            <button type="submit" class="btn btn-secondary">Search</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                </div>
                <div class="form-group col-lg-2 col-12" >
                  <h5 style="text-align: center;">Company Name</h5>  
                  <br>
                  <form action="maintenance_list.php" method = "POST">
                    <div class="row" >
                      <div class="form-group col-lg-8 col-12">
                        <input type="text" placeholder="Name" class="form-control" id="un" name="un">
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <button type="submit" class="btn btn-secondary">Search</button>
                        
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
                  </div>

                </div>
                      <!-- /.card-body -->
              </div>
                  <!-- /.card -->
            </div>

          </div>
        </div>
      

      
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Are you sure?</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
              </div>
              <div class="modal-body">
                <form action="maintenance_list.php" method="POST">
                  <input type="hidden" name="equip_id" id="equip_id">
                  <div class="modal-body" style="float: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='maintenance_list.php'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Comfirm</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        
        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12">
              <h2 style="margin-left: 25px;">Maintenance Info</h2>
            </div>
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add New Equipment</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="equipments_list.php" method="POST">
                        <div class="modal-body">

                          <input type="hidden" name="snoEdit" id="snoEdit">
                          <div class="row">
                            <div class="form-group col-lg-6 col-12">
                              <label for="name">Equipment Name</label>
                              <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                              <label for="quantity">Quantity</label>
                              <input type="text" class="form-control" id="quantity" name="quantity" aria-describedby="emailHelp">
                            </div>

                          </div>

                          <div class="row">
                            <div class="form-group col-lg-6 col-12">
                              <label for="brand">Brand</label>
                              <input type="text" class="form-control" id="brand" name="brand" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                              <label for="model">Model</label>
                              <input type="text" class="form-control" id="model" name="model" aria-describedby="emailHelp">
                            </div>

                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add Equipment</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /Insert Modal -->


            </div>
          </div>
        </div>

        <div class="bg-light clearfix">
          <div class="row" style="padding-top: 30px;">
            <div class="col-lg-6 col-md-12" style="padding-top: 15px;padding-right:40px;">
              <!-- Insert Modal -->
              <!-- <button type="button" class="insert btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Add New</button> -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel2">Edit Info</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <form action="equipments_list.php" method="POST">
                        <div class="modal-body">

                          <input type="hidden" name="equip_id2" id="equip_id2">
                          <!-- <div class="row"> -->
                          <div class="form-group">
                            <label for="quantity1">Quantity</label>
                            <input type="text" class="form-control" id="quantity1" name="quantity1" aria-describedby="emailHelp">
                          </div>
                          <!-- <div class="form-group col-lg-6 col-12">
                              <label for="available1">Available</label>
                              <input type="text" class="form-control" id="available1" name="available1" aria-describedby="emailHelp">
                            </div> -->

                          <!-- </div> -->


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='equipments_list.php'">Close</button>
                          <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /Insert Modal -->


            </div>
          </div>
        </div>



        <div class="card-body" style="margin-top:1%">

          <table class="table table-hover table-striped" id='myTable'>
            <thead>
              <tr>
                <th scope="col">Equipment ID</th>
                <th scope="col">Repairer Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Repairer Company Name</th>
                <th scope="col">Maintenance Date</th>
                <th scope="col">Delivery Date</th>
                <th scope="col">Cost of Repairing</th>
                <th scope="col">Status</th>
                <?php
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
                  echo '<th scope="col">Action</th>';
                }
                ?>

              </tr>
            </thead>
            <tbody>
              <?php
              if($donewithin) {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname') and (DELIVERY_DATE-SYSDATE) <= $dw";
              }
              elseif($company) {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname') and REPAIRER_COMPANY_NAME = '$un'";
              }
              elseif($costg) {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname') and COST_OF_REPAIRING >= $em";

              }
              elseif($costl) {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname') and COST_OF_REPAIRING <= $el";

              }
              elseif($history) {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname') and (SYSDATE - MAI_DATE) <= $hp";

              }
              else {
                $sql = "select * from maintenance natural join equipment where br_name = (select br_name from users where username = '$uname')";
              }
              
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "
              <tr>
              <th scope='row'>" . $row['EQUIPMENT_ID'] . "</th>
              <td>" . $row["REPAIRER_NAME"] . " </td>
              <td>" . $row["REPAIRER_CONTACT_NO"] . "</td>
              <td>" . $row["REPAIRER_COMPANY_NAME"] . "</td>
              <td>" . $row["MAI_DATE"] . "</td>
              <td>" . $row["DELIVERY_DATE"] . "</td>
              <td>" . $row["COST_OF_REPAIRING"] . "</td>
              <td>"; 
              if($row["CUR"] == '1') {
                echo "Under Maintenance";
              } 
              else {
                echo "Done";
              }
              echo "</td>";
              
                if ($_GET == NULL || ($_GET != NULL && ($_GET['un'] == 'd' || $_GET['un'] == 'w' || $_GET['un'] == 'i' || $_GET['un'] == 'u'))) {
                  if($row["CUR"] == '1' ) {
                  echo "<td> <button class='delete btn btn-sm btn-success'>Done</button>";
                  }
                  else {
                    echo "<td> </td>";
                  }
                }
                echo "</tr>
              ";
                // ECHO var_dump($row);
              }



              ?>

            </tbody>
          </table>



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
    <footer class="main-footer dark-mode" style="color: #869099">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    inserts = document.getElementsByClassName('insert');
    Array.from(inserts).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("insert ", e.target);
        // $('#exampleModal').modal('toggle');
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("delete ", );
        tr = e.target.parentNode.parentNode;
        equip_id.value = tr.getElementsByTagName("th")[0].innerText;
        console.log(equip_id);
        $('#exampleModal1').modal('toggle');
      })
    })
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("update ", );
        tr = e.target.parentNode.parentNode;
        // // uname.value = e.target.id;
        // // designation.value = tr.id;
        equip_id2.value = tr.getElementsByTagName("th")[0].innerText;
        quantity1.value = tr.getElementsByTagName("td")[3].innerText;
        // available1.value = tr.getElementsByTagName("td")[4].innerText;
        console.log(equip_id2.value, quantity1.value);
        // // console.log(emp_id);
        $('#exampleModal2').modal('toggle');
      })
    })
  </script>
</body>

</html>