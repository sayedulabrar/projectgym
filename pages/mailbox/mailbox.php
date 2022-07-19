<?php

session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc



$uname = $_SESSION['uname'];

$job= $_SESSION['profation'];


$conn = oci_connect('Abrar', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {

  if($job!="Member")
  {
    $sql="Select EMP_ID FROM EMPLOYEE where USERNAME='$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $reciverid=$row['EMP_ID'];
  }else
  {

    $sql="Select MEM_ID FROM MEMBER where USERNAME='$uname'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
    $reciverid=$row['MEM_ID'];
  }

  
  

  
}

   ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $job ?> | Mailbox</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>


<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $job; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $uname; ?></a>
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

                <!-- <li class="nav-item">
                  <a href="../../f1.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v2</p>
                  </a>
                </li> -->

                <?php

                  if($job=="trainer")
                  {
                    echo ' <li class="nav-item">
                    <a href="../../trainer_db.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Trainer</p>
                    </a>
                  </li>';
                  }
                  if($job=="receptionist")
                {
                    echo ' <li class="nav-item">
                    <a href="../../receptionist.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Receptionist</p>
                    </a>
                    </li>';
                }

                if($job=="manager")
                {
                    echo ' <li class="nav-item">
                    <a href="../../manager_db.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manager</p>
                    </a>
                    </li>';
                }

                ?>

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
                  <a href="../mailbox/mailbox.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../mailbox/compose.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li>

              </ul>
            </li>
            <!-- <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  UserPages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="../examples/profilev2.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="../examples/package.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Package</p>
                  </a>

                <li class="nav-item">
                  <a href="../examples/Search-Trainer.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Search Trainer</p>
                  </a>





              </ul>
            </li> -->


            <?php

                  if($job=="trainer" || $job=="receptionist" || $job=="manager")
                  {

                  }
                  else
                  {
                    echo '<li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        UserPages
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
      
                      <li class="nav-item">
                        <a href="../examples/profilev2.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Profile</p>
                        </a>
                      </li>
      
      
      
                      <li class="nav-item">
                        <a href="../examples/package.html" class="nav-link ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Package</p>
                        </a>
      
                      <li class="nav-item">
                        <a href="../examples/Search-Trainer.html" class="nav-link ">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Search Trainer</p>
                        </a>
      
      
      
      
      
                    </ul>
                  </li>';
                  }

            ?>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top:0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Inbox</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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






        <div class="table-responsive mailbox-messages" style="margin-top:2%">
          <table class="table table-hover table-striped">
            
            <thead>
              <tr>
              
               
                <td class="mailbox-name"><a href="read-mail.html">From </a></td>
                <td class="mailbox-subject"><b>Subject</b> 
                </td>
                <td class="mailbox-date">Recived</td>
              
              </tr>
          </thead>



          
              

          <tbody>




          <?php
          

          
              $sql = "Select MES_ID, RECIEVER_ID, SUBJECT,S_DATE, USERNAME  From MESSAGE JOIN EMPLOYEE  ON (EMPLOYEE.EMP_ID=MESSAGE.SENDER_ID)
              where RECIEVER_ID = '$reciverid'";
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);
              $roa = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
              if($roa!=NULL){

              $sql = "Select MES_ID, RECIEVER_ID, SUBJECT,S_DATE, USERNAME  From MESSAGE JOIN EMPLOYEE  ON (EMPLOYEE.EMP_ID=MESSAGE.SENDER_ID)
              where RECIEVER_ID = '$reciverid'";
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);


                while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                  $us = $row['MES_ID'];
                  $nm=$row['USERNAME'];
                  $rc=$row['S_DATE'];
                  $sb=$row['SUBJECT'];

                  echo "
                <tr >
                <th scope='row'>" . $nm . "</th>
                <td><a href='readmail.php?us=".$us."&nm=".$nm."&rnm=Admin'>" . $sb. "</a></td>
                <td>" . $rc . "</td>
                </tr>";



                  
                
                }
              }else
              {
                $sql = "Select MES_ID, RECIEVER_ID, SUBJECT,S_DATE, USERNAME  From MESSAGE JOIN MEMBER  ON (MEMBER.MEM_ID=MESSAGE.SENDER_ID)
                where RECIEVER_ID = '$reciverid'";
                $stid = oci_parse($conn, $sql);
                $r = oci_execute($stid);
  
              $roa = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);



              if($roa!=NULL){


                $sql = "Select MES_ID, RECIEVER_ID, SUBJECT,S_DATE, USERNAME  From MESSAGE JOIN MEMBER  ON (MEMBER.MEM_ID=MESSAGE.SENDER_ID)
              where RECIEVER_ID = '$reciverid'";
              $stid = oci_parse($conn, $sql);
              $r = oci_execute($stid);


              while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $us = $row['MES_ID'];
                $nm=$row['USERNAME'];
                $rc=$row['S_DATE'];
                $sb=$row['SUBJECT'];

                echo "
              <tr >
              <th scope='row'>" . $nm . "</th>
              <td><a href='readmail.php?us=".$us."&nm=".$nm."&rnm=Admin'>" . $sb. "</a></td>
              <td>" . $rc . "</td>
              </tr>";



              }

              }

              

            }
              
              

              ?>

              

            <!-- </tbody>
          </table> -->
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
   
</body>

</html>
