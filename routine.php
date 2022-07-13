<?php
  session_start();
  $uname = $_SESSION['uname'];
  
  $test = NULL;
  $val = null;
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
    or die(oci_error());
if (!$conn) {
    echo "Sorry";
} else {
  $username = $_GET['un']; 
  $test = $_GET;
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['followedset'])) {
      $val = $_POST['followedset'];
      $sql = "update member set f_set = $val where username = '$username'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $_SESSION['routine'] = 'u';
    }
    if(isset($_POST['exe_name'])) {
      $exe_name = $_POST['exe_name'];
      $sql = "select *from exercises_list where exe_name = '$exe_name'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if($row == NULL ) {
        $_SESSION['routine'] = 'w';
      }
      else {
        $exe = $row['EXE_ID'];
        if(isset($_POST['sat'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 1)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['sun'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 2)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['mon'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 3)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['tue'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 4)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['wed'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 5)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['thu'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 6)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        if(isset($_POST['fri'])) {
          $sql = "insert into routine (username, exe_id, days) values ('$username', $exe, 7)";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
        }
        $_SESSION['routine'] = 'i';
      }
      
    }
    if(isset($_POST['exe_id']) && isset($_POST['day'])) {
      $day = null;
      $exe_id = $_POST['exe_id'];
      if($_POST['day'] == 'Saturday') {
        $day = 1;
      }
      elseif($_POST['day'] == 'Sunday') {
        $day = 2;
      }
      elseif($_POST['day'] == 'Monday') {
        $day = 3;
      }
      elseif($_POST['day'] == 'Tuesday') {
        $day = 4;
      }
      elseif($_POST['day'] == 'Wednesday') {
        $day = 5;
      }
      elseif($_POST['day'] == 'Thursday') {
        $day = 6;
      }
      elseif($_POST['day'] == 'Friday') {
        $day = 7;
      }
      $sql = "DELETE FROM routine WHERE username = '$username' and days = $day and exe_id = $exe_id";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $_SESSION['routine'] = 'd';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Routine</title>

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
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
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

     
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Fitness Mania</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="employee_profile.php?un_=trainer" class="d-block"><?php echo $uname; ?></a>
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
      </div>
    </aside>
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Are you sure you want to remove equipment</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
              </div>
              <div class="modal-body">
                <form action="routine.php?un=<?php echo $username; ?>" method="POST">
                  <input type="hidden" name="exe_id" id="exe_id">
                  <input type="hidden" name="day" id="day">
                  <div class="modal-body" style="float: right;">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='routine.php'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Comfirm</button>
                  </div> 
                </form>
              </div>

            </div>
          </div>
        </div>
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php
          
            if($_SESSION['routine'] == 'i') {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Successfully inserted
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
            $_SESSION['routine'] = NULL;
              
            }
            if($_SESSION['routine'] == 'w') {
              echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
              Given Exercise Name is wrong. To clear confusion click at 'Exercise List' button
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
            $_SESSION['routine'] = NULL;
            }
            if($_SESSION['routine'] == 'd') {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Successfully Deleted
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
            $_SESSION['routine'] = NULL; 
            }
            if($_SESSION['routine'] == 'u') {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              Successfully updated Followed Set
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
            $_SESSION['routine'] = NULL; 
            }
            
        ?>
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Routine</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <h5 class="m-0 float-right">Followed Set: 
                  <?php
                    $sql = "select * from member where USERNAME = '$username'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                    if($row) {
                      if($row['F_SET'] == 1) {
                        echo "Beginner";
                      }
                      else if($row['F_SET'] == 2) {
                        echo "Indermediate";
                      }
                      else if($row['F_SET'] == 3) {
                        echo "Advanced";
                      }
                      else {
                        echo "Not Set Yet";
                      }
                    }
                  ?>
                    
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
              <h4 class="d-flex">Saturday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 1";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                    
                    
                  
                 
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
              <h4 class="d-flex">Sunday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 2";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                      


                      
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
              <h4 class="d-flex">Monday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 3";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                      
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
              <h4 class="d-flex">Tuesday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 4";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                        
                 
    


                      


                 
                 
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
              <h4 class="d-flex">Wednesday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 5";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                     
                 
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
              <h4 class="d-flex">Thursday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 6";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                    
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
              <h4 class="d-flex">Friday</h4>

              <div class="card-tools">
               
              </div>
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Id</th>
                    <th>Exercise Name</th>
                    <th>Exercise Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 
                      $sql = "select * from routine natural join exercises_list where USERNAME = '$username' and days= 7";
                      $stid = oci_parse($conn, $sql);
                      $r = oci_execute($stid);
                      while($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo '
                        <tr class="mem_routine">
                        <td>'.
                          $row['EXE_ID']
                        .'</td>
                        <td>'.
                          $row['EXE_NAME']
                        .'</td>
                        <td>'.
                          $row['EXE_TYPE']
                        .'</td> 
                        <td>
                        <button class="delete btn btn-sm btn-danger">Delete</button>
                        </td>
                        </tr>
                        ';
                      }
                    ?>
                   
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
             

              
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
               
                <tbody>
                  <tr class="mem_routine">
                    <td><b>Followed Set</b>
                        
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                    <td>
                        
                        <form action="routine.php?un=<?php echo $username;?>" method="POST">
                          <div class="row">
                            <div class="form-group col-lg-8 col-12">
                              <!-- <label for="type">Package Type</label> -->
                              <select name="followedset" id="followedset" class="form-select" aria-label="Default select example" style="width: 300px; height: 37px;">
                                <option selected value="1">Beginner</option>
                                <option value="2">Indermediate</option>
                                <option value="3">Advanced</option>
                              </select>
                            </div>
                            <div class="form-group col-lg-4 col-12">
                              <button type="submit" class="btn btn-success">Add/Change</button>
                            </div>
                          </div>
                          
                          
                        </form>
                    </td> 
                    
        
                  </tr>

                </tbody>
              </table>

            </div>

          </div>

          
        </div>
      </section> 




     <section class="content"> 
        <div class="container-fluid">
           
          </div>
          <div class="card" >
            <div class="card-header border-transparent"  id="day_exe">
             

              
            </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Exercise Name</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Action</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="mem_routine">
                    <form action="routine.php?un=<?php echo $username?>" method="POST">
                    <td>
                            <div class="form-group">
                              <input type="text" class="form-control" id="exe_name" name="exe_name" placeholder="Exercise Name">
                            </div>
                    </td>
                    
                    <td>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="sat" name="sat">
                            
                        </div>
                    </td> 
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="sun" name="sun" >
                            
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="mon" name="mon" >
                            
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="4" id="tue" name="tue" >
                            
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="5" id="wed" name="wed" >
                            
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="6" id="thu" name="thu" >
                            
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="7" id="fri" name="fri">  
                        </div>
                    </td>
                    
                    <td>
                      <div class="container">
                        <div class="col-md-12 text-center">
                          <button type="submit" class="btn btn-success btn-block">Add into Routine</button>
                        </div> 
                      </div>
                    </td>
                    <td>
                      <a href="exercises_list.php" class="btn btn-warning" role="button">Exercise list</a>
                    </td>
                    </form>
                  </tr>

                </tbody>
              </table>

            </div>

          </div>

          
        </div>
      </section> 


      

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
      element.addEventListener("click", (e)=>{
        // console.log("delete ", );
        tr = e.target.parentNode.parentNode;
        // equip_id.value = tr.getElementsByTagName("th")[0].innerText;
        exe_id.value = tr.getElementsByTagName("td")[0].innerText;
        tr = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        tr1 = tr.getElementsByTagName("div")[0];
        day.value = tr1.getElementsByTagName("h4")[0].innerText;
        console.log(day.value);
        $('#exampleModal1').modal('toggle');
      })
    })
  </script>
</body>

</html>