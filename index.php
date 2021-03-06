<?php
session_start();
$wrongInfo = false;
$conn = oci_connect('brownfalcon_gms', 'saif0rrahman', 'localhost/xe')
  or die(oci_error());
if (!$conn) {
  echo "sorry";
} else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['uname'] = $username;
    $_SESSION['profile'] = $username;
    $sql = "select * from users where USERNAME = '$username' and PASSWORD = '$password'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

    if ($username == 'Admin1' && $password == 'admin') {
      $_SESSION['profation'] = 'Admin';
      header("Location: admin_db.php");
    } elseif ($row == NULL) {
      $wrongInfo = true;
    } else {
      $sql = "select * from employee where USERNAME = '$username'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
      if ($row == NULL) {
        $_SESSION['profation'] = 'Member';
        header("Location: member_db.php");
      } else {
        if ($row['DESIGNATION'] == 'Manager') {
          $_SESSION['profation'] = 'Manager';
          header("Location: manager_db.php");
        } elseif ($row['DESIGNATION'] == 'Trainer') {
          $_SESSION['profation'] = 'Trainer';
          header("Location: trainer_db.php");
        } elseif ($row['DESIGNATION'] == 'Receptionist') {
          $_SESSION['profation'] = 'Receptionist';
          header("Location: receptionist.php");
        } else {
          $_SESSION['profation'] = 'Admin';
          header("Location: admin_db.php");
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
  body {
    background: url(dist/img/namaste1.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

  }
</style>

<body class="hold-transition login-page">


  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1">Fitness Mania</a>
      </div>
      <div class="card-body">
        <?php
        if ($wrongInfo == true) {
          echo "<p style='color: red'>Wrong Info</p>";
        }
        ?>
        <p class="login-box-msg">Sign in to your account</p>

        <form action="index.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">

        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
        <!-- /.social-auth-links -->



      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>