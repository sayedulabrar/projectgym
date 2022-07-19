<?php
session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
$showuname = $_SESSION['uname'];
$wrongPassword = false;
$matchPassword = true;
$nullPassword = false;
if ($_GET == NULL) {
  $uname = $_SESSION['uname'];
} else {
  $uname = $_GET['un'];
  if ($uname == 'w' || $uname == 'm' || $uname == 'n') {
    if ($uname == 'w') {
      $wrongPassword = true;
    } else if ($uname == 'm') {
      $matchPassword = false;
    } else {
      $nullPassword = true;
    }
    $uname =  $_SESSION['uname'];
  }
  // if($uname = 'trainer') {
  //   $trainer = true;
  //   $uname =  $_SESSION['uname'];
  // }
}

// echo var_dump($_GET);

$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  $sql = "select *from MEMBER natural join users where username = '$uname'";
  $stid = oci_parse($conn, $sql);
  $r = oci_execute($stid);
  $userJoinMember = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name1'])) {
      $name = $_POST['name1'];
      $gender = $_POST['gender1'];
      $bloodgroup = $_POST['bloodgroup1'];
      $dob = $_POST['dob1'];
      $email = $_POST['email1'];
      $address = $_POST['address1'];
      $account = $_POST['account1'];

      $sql = "update users set name = '$name', gender = '$gender', blood_grp = '$bloodgroup', dob= to_date('$dob', 'dd-mon-yy'), email = '$email', address= '$address', account_no = $account where username = '$uname'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $sql = "DELETE FROM USER_MOBILENO WHERE username = '$uname'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);

      $mobileno = $_POST['mobile1'];
      $array = explode(",", $mobileno);
      $test = count($array);
      $i = 0;
      while ($test <> $i) {
        $sql = "insert into user_mobileno (username, mobile_no) values ('$uname', '$array[$i]')";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $i = $i + 1;
      }
    }
    if (isset($_POST['oldpass'])) {
      $sql = "select * from users where username = '$uname'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      echo $row['PASSWORD'];
      if ($_POST['oldpass'] == $row['PASSWORD']) {
        echo "yes";
        if ($_POST['newpass'] == $_POST['cpass']) {
          if ($_POST['newpass'] == NULL) {
            $nullPassword = true;
          } else {
            $sql = "update users set password = '$_POST[newpass]' where username = '$uname'";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
          }
        } else {
          $matchPassword = false;
        }
      } else {
        $wrongPassword = true;
      }
    }
    if ($wrongPassword == true) {
      header("Location: member_profile.php?un=w");
    } else if ($matchPassword == false) {
      header("Location: member_profile.php?un=m");
    } else if ($nullPassword == true) {
      header("Location: member_profile.php?un=n");
    } else {
      header("Location: member_profile.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

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
          <form action="member_profile.php" method="POST">
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
              <button type="button" class="btn btn-secondary" onclick="window.location.href='member_profile.php'">Close</button>
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
          <form action="member_profile.php" method="POST">

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
              <button type="button" class="btn btn-secondary" onclick="window.location.href='member_profile.php'">Cancel</button>
              <button type="submit" class="btn btn-primary">Comfirm</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>



  <div class="wrapper">

    <?php
    if ($_GET == NULL || $wrongPassword == true || $matchPassword == false || $nullPassword == true) {
      echo '
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
                <a href="member_profile.php" class="d-block">';
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
                      <a href="member_db.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Member</p>
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
    
                    </li>
                    <li class="nav-item">
                      <a href="member_profile.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Profile</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="package.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Packages</p>
                      </a>
                    </li>
                    <!-- <li class="nav-item">
                      <a href="add_employee.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Add Employee</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="add_member.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Add Member</p>
                      </a>
                    </li> -->
                    <!-- <li class="nav-item">
                      <a href="pages/examples/Branch.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Branch</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="pages/examples/Search-Manager.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Search Manager</p>
                      </a>
                    </li> -->
    
    
    
    
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
      <!-- Main Sidebar Container -->
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
              <a href="employee_profile.php" class="d-block">';
      echo $_SESSION['uname'];
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
                    <a href="manager_db.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manager</p>
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
                    <a href=" pages/mailbox/mailbox.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inbox</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href=" pages/mailbox/compose.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compose</p>
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
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper dark-mode" style="margin-top: 0;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php
                                                      if ($_GET == NULL || $wrongPassword == true || $matchPassword == false || $nullPassword == true) {
                                                        echo "member_db.php";
                                                      } else {
                                                        echo "manager_db.php";
                                                      }
                                                      ?>">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="roww">
            <div class="col-md-30">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="dist/img/user2-160x160.jpg" alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">
                    <?php
                    echo $userJoinMember["USERNAME"]
                    ?>
                  </h3>

                  <p class="text-muted text-center"></p>
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <h3 style="text-align: center;"><b>Personal Info</b></h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Name</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["NAME"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["EMAIL"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Gender</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["GENDER"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Date of Birth</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["DOB"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Address</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["ADDRESS"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Account Number</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["ACCOUNT_NO"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Mobile_No</b> <a class="float-right">
                            <?php
                            $sql = "select *from user_mobileno where username = '$uname'";
                            $stid = oci_parse($conn, $sql);
                            $r = oci_execute($stid);
                            $num = 0;
                            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                              $num = $num + 1;
                            }
                            $stid = oci_parse($conn, $sql);
                            $r = oci_execute($stid);
                            $n = 0;
                            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                              $n = $n + 1;
                              if ($n == $num) {
                                echo $row["MOBILE_NO"];
                              } else {
                                echo $row["MOBILE_NO"] . ', ';
                              }
                            }
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Blood Group</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["BLOOD_GRP"];
                            ?>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                      <h3 style="text-align: center;"><b>Gym Related Info</b></h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Member ID</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["MEM_ID"];
                            ?>
                          </a>
                        </li>

                        <li class="list-group-item">
                          <b>Height</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["MEM_HEIGHT"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Weight</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["MEM_WEIGHT"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>BMI</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["MEMB_BMI"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Branch Name</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["BR_NAME"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Membership Expiry Date</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["MEMBERSHIP_EXPIRY"];
                            ?>
                          </a>
                        </li>
                        <li class="list-group-item">
                          <b>Assigned Trainer</b> <a class="float-right">
                            <?php
                            echo $userJoinMember["TRAINER"];
                            ?>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12 bg-dark text-right">
                          <p style="color: red">
                            <?php
                            if ($wrongPassword == true) {
                              echo "Wrong Password";
                            } else if ($matchPassword == false) {
                              echo "Password does not match";
                            } else if ($nullPassword == true) {
                              echo "Password can not be null";
                            }
                            ?>
                          </p>
                          <?php
                          if ($_GET == NULL || $wrongPassword == true || $matchPassword == false || $nullPassword == true) {
                            echo '
                              <button type="button" class="update btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Edit Info</button>
                              <button type="button" class="pass btn btn-primary"  data-toggle="modal" data-target="#exampleModal1">Change Password</button>
                              ';
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                  </div>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


            </div>
            <!-- /.col -->

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <button onclick="window.location.href='member_list.php'" type="button" class="btn btn-primary" style="padding-left: 20px; padding-right: 20px;">Back</button>
            </div>
        </div>
      </div> -->
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
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script>
    updates = document.getElementsByClassName('update');
    Array.from(updates).forEach((element) => {
      element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode.parentNode.parentNode;
        div1 = tr.getElementsByTagName("div")[0];
        cont1 = div1.getElementsByTagName("ul")[0];

        cont11 = cont1.getElementsByTagName("li")[0];
        name1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[1];
        email1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[2];
        gender1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[4];
        address1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[5];
        account1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[3];
        dob1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[6];
        mobile1.value = cont11.getElementsByTagName("a")[0].innerText;

        cont11 = cont1.getElementsByTagName("li")[7];
        bloodgroup1.value = cont11.getElementsByTagName("a")[0].innerText;

        $('#exampleModal').modal('toggle');
      })
    })
  </script>
</body>

</html>