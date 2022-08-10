<?php
session_start();
if(isset($_SESSION['user_login']))
{
    //echo"<h1>Welcome to profile</h1>";
}
else{
    echo"<script>window.location.href='login.php';</script>";
}

include_once('includes/heads.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include_once('includes/heads.inc.php');?>

<!-- <link rel="stylesheet" href="includes/dashboard.css"> -->
<!-- <link rel="stylesheet" href="includes/navbar.css"> -->
<link rel="stylesheet" href="includes/dashboard.css">
</head>
<body>

<?php include_once("includes/d_nav.php");?>

<div class="container-fluid">
  <div class="row">
    <?php include_once("includes/sidebar.php");?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-end">Dashboard</h1>
      </div>
        <h1 class="display-4 mt-5">Welcome to my website</h1>
    </main>
  </div>
</div>
</body>
</html>