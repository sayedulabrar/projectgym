<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$uname = $_SESSION['uname'];
$job = $_SESSION['profation'];


$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  $sql = "select * from users where USERNAME = '$uname'";
  $stid = oci_parse($conn, $sql);
  $r = oci_execute($stid);
  $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="  plugins/fontawesome-free/css/all.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="  dist/css/adminlte.min.css" />
  </head>

  <body
    class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"
  >

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form action="employee_profile.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="snoEdit" id="snoEdit">
              <div class="row">
                <div class="form-group col-lg-6 col-12">
                  <label for="nam1e">Name</label>
                  <input type="text" class="form-control" id="name1" name="name1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-lg-6 col-12">
                  <label for="gender1">Gender</label>
                  <input type="text" class="form-control" id="gender1" name="gender1" aria-describedby="emailHelp">
                </div>
              </div>
              
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <label for="bloodgroup1">Blood Group</label>
                  <input type="text" class="form-control" id="bloodgroup1" name="bloodgroup1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-lg-6 col-12">
                  <label for="dob1">Date of Birth(eg. 11-NOV-98)</label>
                  <input type="text" class="form-control" id="dob1" name="dob1" aria-describedby="emailHelp">
                </div>
              </div>
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <label for="email1">Email</label>
                  <input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-lg-6 col-12">
                  <label for="address1">Address</label>
                  <input type="text" class="form-control" id="address1" name="address1" aria-describedby="emailHelp">
                </div>

              </div>
              <div class="row">
                <div class="form-group col-lg-6 col-12">
                  <label for="account1">Account No</label>
                  <input type="text" class="form-control" id="account1" name="account1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-lg-6 col-12">
                  <label for="mobile1">Mobile No</label>
                  <input type="text" class="form-control" id="mobile1" name="mobile1" aria-describedby="emailHelp">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='employee_profile.php'">Close</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel1">Change Password</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <form action="employee_profile.php" method="POST">

            <div class="row">
              <div class="form-group col-lg-12 col-12">
                <label for="oldpass">Old Password</label>
                <input type="password" class="form-control" id="oldpass" name="oldpass" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-lg-12 col-12">
                <label for="newpass">New Password</label>
                <input type="password" class="form-control" id="newpass" name="newpass" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-lg-12 col-12">
                <label for="cpass">Confirm Password</label>
                <input type="password" class="form-control" id="cpass" name="cpass" aria-describedby="emailHelp">
              </div>
            </div>


            <div class="modal-body" style="float: right;">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='employee_profile.php'">Cancel</button>
              <button type="submit" class="btn btn-primary">Comfirm</button>
            </div> 
          </form>
        </div>

      </div>
    </div>
  </div>


    <div class="wrapper">
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
            <a href="admin_profile.php" class="d-block"><?php echo $uname; ?>
            </a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="admin_db.php" class="nav-link ">
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
            <li class="nav-item ">
              <a href="#" class="nav-link ">
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


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper dark-mode" style="margin-top: 0">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Profile</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">
                    <a href="admin_db.php">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Admin Profile</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <div class="d-flex justify-content-center">
          <div class="text-center">
            <img
              class="profile-user-img img-fluid img-circle"
              src="  dist/img/user2-160x160.jpg"
              alt="User profile picture"
            />
            <h3 class="profile-username text-center"><?php echo $row['USERNAME']; ?></h3>
          </div>
        </div>
        <div class="d-flex justify-content-around mt-3">
          <!-- Profile Image -->

          <div class="col">
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item pr-3 pl-3">
                <b>Name</b> <a class="float-right"><?php echo $row['NAME'];?></a>
              </li>
              <li class="list-group-item pr-3 pl-3">
                <b>DOB</b> <a class="float-right"><?php 
                  $sql = "select to_char(dob, 'dd/mm/yyyy') from users where USERNAME = '$uname'";
                  $stid = oci_parse($conn, $sql);
                  $r = oci_execute($stid);
                  $row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
                  echo $row1['TO_CHAR(DOB,\'DD/MM/YYYY\')'];
                ?></a>
              </li>
              <li class="list-group-item pr-3 pl-3">
                <b>Email</b> <a class="float-right"><?php echo $row['EMAIL'];?></a>
              </li>
              <li class="list-group-item pr-3 pl-3">
                <b>Gender</b> <a class="float-right"><?php echo $row['GENDER'];?></a>
              </li>
            </ul>
          </div>
          <div class="col">
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item pr-3 pl-3">
                <b>Mobile_No</b> <a class="float-right">
                <?php
                    $sql = "select *from user_mobileno where username = '$uname'";
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $num = 0;
                    while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $num = $num + 1;
                    }
                    $stid = oci_parse($conn, $sql);
                    $r = oci_execute($stid);
                    $n = 0;
                    while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                      $n = $n + 1;
                      if ($n == $num) {
                        echo $row1["MOBILE_NO"];
                      } else {
                        echo $row1["MOBILE_NO"] . ', ';
                      }
                    }
                    ?>
                </a>
              </li>

              <li class="list-group-item pr-3 pl-3">
                <b>Address</b> <a class="float-right"><?php echo $row['ADDRESS'];?></a>
              </li>

              <li class="list-group-item pr-3 pl-3">
                <b>Blood Group</b> <a class="float-right"><?php echo $row['BLOOD_GRP'];?></a>
              </li>
              <li class="list-group-item pr-3 pl-3">
                <b>Account Number</b> <a class="float-right"><?php echo $row['ACCOUNT_NO'];?></a>
              </li>
            </ul>
          </div>

          <!-- /.card-body -->

          <!-- /.card -->

          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="card-footer">
          <div class="float-right">
          <button type="button" class="update btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Edit Info</button>
          <button type="button" class="pass btn btn-primary"  data-toggle="modal" data-target="#exampleModal1">Change Password</button>
          </div>
        </div>

        <!-- /.content -->
        <div style="margin-bottom: 30px"></div>
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
    <script src="  plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="  plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="  dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="  dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element)=>{
      element.addEventListener("click", (e)=>{
        tr = e.target.parentNode.parentNode.parentNode;
        
        // div1 = tr.getElementsByTagName("div")[7];
        cont1 = tr.getElementsByTagName("ul")[0];
        
        // console.log(li);
        // cont1 = div1.getElementsByTagName("ul")[0];

        cont11 = cont1.getElementsByTagName("li")[0];
        name1.value = cont11.getElementsByTagName("a")[0].innerText;
        
        cont11 = cont1.getElementsByTagName("li")[2];
        email1.value = cont11.getElementsByTagName("a")[0].innerText;
        
        cont11 = cont1.getElementsByTagName("li")[3];
        gender1.value = cont11.getElementsByTagName("a")[0].innerText;
        
        cont11 = cont1.getElementsByTagName("li")[1];
        dob1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont1 = tr.getElementsByTagName("ul")[1];

        cont11 = cont1.getElementsByTagName("li")[1];
        address1.value = cont11.getElementsByTagName("a")[0].innerText;
        
        cont11 = cont1.getElementsByTagName("li")[3];
        account1.value = cont11.getElementsByTagName("a")[0].innerText;
        
       
        
        cont11 = cont1.getElementsByTagName("li")[0];
        mobile1.value = cont11.getElementsByTagName("a")[0].innerText;
        
        cont11 = cont1.getElementsByTagName("li")[2];
        bloodgroup1.value = cont11.getElementsByTagName("a")[0].innerText;

        $('#exampleModal').modal('toggle');
      })
    })
  </script>
  </body>
</html>
