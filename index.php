<?php
session_start();
require_once('includes/db.php');
if (isset($_SESSION['user_login'])) {
  echo "<script>window.location.href='dashboard.php';</script>";
} else {
  //echo"<script>window.location.href='login.php';</script>";
}
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `users` WHERE email = :email");
  $sql->execute(array(':email' => $email));
  $result = $sql->fetchObject();
  if ($result->total > 0) {
    $sql = "SELECT * from users WHERE email='$email' AND `password`='$password'";
    $result = $conn->query($sql);
    while ($row = $result->fetch()) {
      $_SESSION['user_login']      = true;
      $_SESSION['user_id']         = $row['id'];
      echo "<script>window.location.href='dashboard.php';</script>";
    }
    $err_message = "Invalid Username or Password";
  } else {
    $err_message = "User does not exist. Please Sign up before logging in.";
  }
} else {
}

//include_once('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include_once('includes/heads.inc.php');?>

<!-- <link rel="stylesheet" href="includes/dashboard.css"> -->
<!-- <link rel="stylesheet" href="includes/navbar.css"> -->
<link rel="stylesheet" href="includes/styles.css">
</head>
<body>

  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-6">
        <div class="display-5">Logo</div>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur vel excepturi nesciunt, in accusamus perspiciatis vitae quaerat earum rem doloremque, culpa numquam impedit voluptatem repellendus officiis temporibus possimus eaque voluptatum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque illum repudiandae ea architecto mollitia modi repellat amet magni. Architecto, voluptatibus distinctio sint fugiat vitae similique animi vel repudiandae commodi quisquam.</p>
      </div>
      <div class="col-sm-1 text-center"></div>
      <div class="col-sm-5 text-center">
        <form class="mx-1 mx-md-4 login-form p-5" method="POST" action="">
          <div class="d-flex flex-row align-items-center mb-4">
            <div class="form-outline flex-fill mb-0">
              <input type="email" name="email" id="form-email" class="form-control" placeholder="Your Email" />
            </div>
          </div>
          <div class="d-flex flex-row align-items-center mb-4">
            <div class="form-outline flex-fill mb-0">
              <input type="password" name="password" id="form-pass" class="form-control" placeholder="Password" />
            </div>
          </div>
          <div class="text-start">
            <a href="forgot_password.php">Forgot Password ?</a>
          </div>
          <div class="d-grid form-outline flex-fill mt-2">
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
          </div>
          <hr>
          <div class="d-grid form-outline flex-fill">
            <a href="register.php" class="btn btn-success" style="background-color:#4eb93f;">Register</a>
          </div>
        </form>

      </div>
    </div>
  </div>
<br><br>

<div class="container">

  <?php include_once('includes/carousel.php'); ?>
</div>


  <div class="container">
    <div class="row mt-5">
      <!-- <h1 class="display-4 mt-5">Welcome to my website</h1> -->
      <hr>
    </div>
    <br>
    <!-- Three columns of text below the carousel -->
    <div class="row text-center">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-white bg-primary">Plan A</div>
          <div class="card-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus perspiciatis omnis a. Dolores nisi sapiente aliquid velit iusto. Consequuntur perferendis dignissimos, minima labore quam libero ex dolores magnam aut veniam!</div>
        </div>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-white bg-warning">Plan B</div>
          <div class="card-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus perspiciatis omnis a. Dolores nisi sapiente aliquid velit iusto. Consequuntur perferendis dignissimos, minima labore quam libero ex dolores magnam aut veniam!</div>
        </div>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-white bg-info">Plan C</div>
          <div class="card-body">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus perspiciatis omnis a. Dolores nisi sapiente aliquid velit iusto. Consequuntur perferendis dignissimos, minima labore quam libero ex dolores magnam aut veniam!</div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
  </div>


<?php include_once('includes/footer.php')?>

</body>
</html>