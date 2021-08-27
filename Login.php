<?php
   require_once "pdo.php";
?> 
 <?php
    session_start();

    if(isset($_REQUEST['btn_login'])) {
      $username = strip_tags($_REQUEST["username_email"]);
      $email = strip_tags($_REQUEST["username_email"]);
      $password = strip_tags($_REQUEST["password"]);
      

      if(empty($username)){      
        $_SESSION["error"]="please enter username or email"; 
      }
      else if(empty($email)){
       $_SESSION["error"]="please enter username or email"; 
      }
      else if(empty($password)){
        $_SESSION["error"]="please enter password";
      }
      else
      {
       try
       {
        $select_stmt=$pdo->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
        $select_stmt->execute(array(':username'=>$username, ':email'=>$email));
        $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

        if($select_stmt->rowCount() > 0) {
          if($username==$row["username"] OR $email==$row["email"]){
            if(password_verify($password, $row["password"])){
              $_SESSION["user_login"] = $row["user_id"];
              $_SESSION["success"] = "Logged in.";
              header( 'location: Mimblog.php');
              return;
            }else{
              $_SESSION["error"]="Incorrect username or password";} 
          }else{
           $_SESSION["error"]="Incorrect username or password";}
        }else{
         $_SESSION["error"]="Incorrect username or password";}
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
 <title>Login</title>
 <link rel="stylesheet" type="text/css" href="L0gin.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
       <label style="padding: 5px;" for="fname"><i class="fa fa-user" style="color: lightgrey"></i> Username</label>   or  <label style="padding: 5px;" for="email"><i class="fa fa-envelope" style="color: lightgrey"></i> Email</label>
      <input class="input-lg form-control" type="text" name="username_email" value="">
    </div>
    <div class="form-group">
       <label for="fname"><i class="fa fa-password"></i> Password</label>
      <input class=" input-lg form-control" type="password" name="password" value="">
    </div>
    <div class="form-group">
      <input class=" btn btn-primary" type="submit" value="Sign in" name="btn_login">
    </div>
    <div>
       <div>If you don't have an acount,<a class="ew" href="signup.php" class="">  Create an account</a></div><br>
            <a class="ew" href="#0" class="f6 link dim black db">Forgot password?</a>
    </div>
    
  </div>
  </form>
</div><br><br><br><br><br><br>

<footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>
</body>