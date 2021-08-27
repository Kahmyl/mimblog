<?php

session_start();
require_once "pdo.php";


if(isset($_REQUEST['btn_register'])) 
{
 $username = strip_tags($_REQUEST['username']); 
 $email  = strip_tags($_REQUEST['email']);  
 $password = strip_tags($_REQUEST['password']); 
  
 if(empty($username)){
  $_SESSION["error"]="Please enter username"; 
 }
 else if(empty($email)){
 $_SESSION["error"]="Please enter email";  
 }
 else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
 $_SESSION["error"]="Please enter a valid email address";  
 }
 else if(empty($password)){
  $_SESSION["error"]="Please enter password";
 }
 else if(strlen($password) < 6){
  $_SESSION["error"] = "Password must be atleast 6 characters"; 
 }
 else
      {
       try
       {
         if(!isset ($_SESSION["error"])) {
          $new_password = password_hash($password, PASSWORD_DEFAULT);
          $insert_stmt=$pdo->prepare("INSERT INTO users (username,email,password) VALUES
                (:uname,:uemail,:upassword)");
          if($insert_stmt->execute(array( ':uname' =>$username, 
                                    ':uemail'=>$email, 
                                    ':upassword'=>$new_password))){
            $_SESSION["success"]="Register Successfully..... Please Login ";
            $_SESSION["user_signup"] = $row["user_id"];
            header( 'location: app2.php');
            return;
          }else{
            $_SESSION["error"]="Email or Username already exists";
          }
        }else{
           $_SESSION["error"]="Email or Username already exists";
        }  

        
    }
    catch(PDOException $e)
   {
    $e->getMessage();
  }  
 }

}
?>
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
     <title>sign_up</title></head>
      <link rel="stylesheet" type="text/css" href="Login.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body style="background: ghostwhite;">

<?php
    if ( isset($_SESSION["error"]) ) {
        echo ('<p style="color:red; text-align:center;" >'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
    if ( isset($_SESSION["success"]) ) {
        echo ('<p style="color:green; text-align:center;">'.$_SESSION["success"]."</p>\n");
        unset($_SESSION["success"]);
    }
?>   
  <div class="container justify-content-center" style="padding: 20px; padding-top: 100px; max-width: 25rem;">
  <div class="card"  style="padding: 20px; max-width: rem;  box-shadow: 0 8px 10px 0 rgba(0,0,0,0.98);">
    <form method="POST">
    <div class="form-group">
      <label style="padding: 5px;" for="email"><i class="fa fa-envelope" style="color: lightgrey"></i> Email</label>
      <input class="input-lg form-control" type="text" name="email" value="">
    </div>
    <div class="form-group">
       <label style="padding: 5px;" for="fname"><i class="fa fa-user" style="color: lightgrey"></i> Username</label>  
      <input class="input-lg form-control" type="text" name="username" value="">
    </div>
    <div class="form-group">
       <label for="fname"><i class="fa fa-password"></i> Password</label>
      <input class=" input-lg form-control" type="password" name="password" value="">
    </div>
    <div class="form-group">
      <input class=" btn btn-primary" type="submit" value="Sign up" name="btn_register">
    </div>
    <div>
       <div>If you already have an acount, <a class="ew" href="Login.php" class="">   Log in </a></div><br>
    </div>
    
  </div>
  </form>
</div>
	<br><br><br><br><br>
<footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>

	

</body>
</html>