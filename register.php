<?php
// Check user login
session_start();
if (isset($_SESSION['user_login'])) {
  echo "<script>window.location.href='dashboard.php';</script>";
} else {
  //echo"<script>window.location.href='login.php';</script>";
}
require_once("includes/db.php");
if (isset($_POST['register'])) {
  $email = $_POST['email'];
  $pass  = $_POST['pass'];
  $cpass = $_POST['cpass'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $dob = $_POST['dob'];


  if ($email != '' && $pass != '' && $cpass != '' && $pass == $cpass) {
    $sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `users` WHERE email = :email");
    $sql->execute(array(':email' => $email));
    $result = $sql->fetchObject();
    if ($result->total > 0) {
      $err_message = "User already exists";
    } else {

      $sql = "INSERT INTO `users`(`fname`, `lname`, `dob`, `email`, `password`) VALUES ('$fname','$lname','$dob','$email','$pass')";
      $conn->exec($sql);
      echo "<script>window.location.replace('index.php') </script>";
    }
  } else {
    $err_message = "Please fill out all the fields.";
    if ($pass != $cpass) {
      $err_message = "Please make sure Password and Confirm Password are same.";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once('includes/heads.inc.php'); ?>
  <link rel="stylesheet" href="includes/styles.css">

  <title>Document</title>
</head>

<body>
  <?php include_once("includes/navbar.inc.php"); ?>
  <section class="vh-100" style="background-color: #eee;">
    <div class="row justify-content-center">
      <?php
      if (isset($err_message)) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error !</strong> <?= $err_message; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
      }
      ?>
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
        <form class="mx-1 mx-md-4" action="" method="POST">
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
              <input type="text" id="form-fname" class="form-control" placeholder="First Name" name="fname" required />
              <input type="text" id="form-lname" class="form-control" placeholder="Last Name" name="lname" required />
          </div>
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-calendar fa-lg me-2 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="date" id="form-dob" class="form-control" placeholder="Date of Birth" name="dob" required />
            </div>
          </div>
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-envelope fa-lg me-2 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="email" id="form-email" class="form-control" placeholder="Your Email" name="email" required />
            </div>
          </div>
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-lock fa-lg me-2 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="password" id="form-pass" class="form-control" placeholder="Password" name="pass" required />
            </div>
          </div>
          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-key fa-lg me-2 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="password" id="form-cpass" class="form-control" placeholder="Confirm your password" name="cpass" required />
            </div>
          </div>
          <!-- <div class="d-flex gap-2 justify-content-center mx-4 mb-3 mb-lg-4"> -->
          <div class="d-grid form-outline flex-fill" style="margin-left:2.1rem!important">
            <button type="submit" name="register" class="btn btn-primary">Register</button>
            <hr>
            <a href="index.php" class="btn btn-success">Login</a>
          </div>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </section>
  <?php include_once('includes/footer.php') ?>
</body>
</html>