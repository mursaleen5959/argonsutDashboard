<?php
// Check user login

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
if(isset($_SESSION['user_login']))
{
    echo"<script>window.location.href='dashboard.php';</script>";
}
else{
    //echo"<script>window.location.href='login.php';</script>";
}

// Include library files 
require 'includes/PHPMailer/src/Exception.php'; 
require 'includes/PHPMailer/src/PHPMailer.php'; 
require 'includes/PHPMailer/src/SMTP.php'; 

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendMail($receiver_mail,$new_pass)
{

    // Create an instance; Pass `true` to enable exceptions 
    $mail = new PHPMailer; 
 
    // Server settings 
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output
//    $mail->SMTPDebug = 4; 
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication


    // ======= C R E D E N T I A L S ======= 
    $mail->Username = 'mail@example.com';       // SMTP username
    $mail->Password = 'app_password_here';         // SMTP password
    // =====================================



    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                      
//    $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
//    $mail->Port = 465;                          // TCP port to connect to
    
    // Sender info 
    $mail->setFrom('mail@example.com', 'Forgot Password'); 
//    $mail->addReplyTo('reply@example.com', 'SenderName'); 
    
    // Add a recipient 
    $mail->addAddress($receiver_mail); 
    
    //$mail->addCC('cc@example.com'); 
    //$mail->addBCC('bcc@example.com'); 
    
    // Set email format to HTML 
    $mail->isHTML(true); 
    
    // Mail subject 
    $mail->Subject = 'Forgot Password Reset'; 
    
    // Mail body content 
    $bodyContent = '<h1>Your Password has been reset</h1>'; 
    $bodyContent .= "<p>Your new password is:{$new_pass}</p>"; 
    $mail->Body    = $bodyContent; 
 
    // Send email 
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
        return false;
    } else { 
        //echo 'Message has been sent.'; 
        return true;
    }
}



require_once("includes/db.php");

if(isset($_POST['forgot']))
{
  $email = $_POST['email'];

 
  if($email!='')
  {
    $sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `users` WHERE email = :email");
    $sql->execute(array(':email' => $email));
    $result = $sql->fetchObject();
    if ($result->total > 0)
    {
        $new_pass = generateRandomString();
        if(sendMail($email,$new_pass)){
            $sql = "UPDATE `users` SET `password`= '$new_pass' WHERE `email`='$email'";
            $conn->exec($sql);
            $msg_type = 'success';
            $err_message = "Email sent successfully !";
        }
        else{
            $msg_type = 'danger';
            $err_message = "Some error occured !";
        }
        //echo "<script>window.location.replace('index.php') </script>";
    }
    else
    {
        $msg_type = 'danger';
        $err_message = "User does not exist !";
    }
  }
  else
  {
    $msg_type = 'danger';
    $err_message = "Please fill out the Email field.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php  include_once('includes/heads.inc.php');?>
<link rel="stylesheet" href="includes/styles.css">

    <title>Document</title>
</head>
<body>
<?php //include_once("includes/navbar.inc.php");?>
<section class="vh-100" style="background-color: #eee;">
    <div class="row justify-content-center">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
        <?php
        if(isset($err_message))
        {
        ?>
            <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
            <strong>Error !</strong> <?=$err_message;?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
        ?>
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Forgot Password ?</p>
        <form class="mx-1 mx-md-4" action="" method="POST">
            <div class="d-flex flex-row align-items-center mb-4">
                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                <div class="form-outline flex-fill mb-0">
                    <input type="email" id="form-email" class="form-control" placeholder="Your Email" name="email" required/>
                </div>
            </div>
            <div class="d-grid form-outline flex-fill" style="margin-left:2.6rem!important">
                <button type="submit" name="forgot" class="btn btn-primary">Submit</button>
            <div>
            <span class="text-start">
                <a href="index.php" class="btn btn-link mt-2">Login here.</a>
            </span>
            <span class="text-end">
                <a href="register.php" class="btn btn-link mt-2">Register here.</a>

            </span>
            </div>
            <hr>
            </div>
        </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</section>

<?php include_once('includes/footer.php')?>

</body>
</html>
