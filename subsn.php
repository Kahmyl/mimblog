<?php
 
    
 require_once 'pdo.php';
    
 
 ?>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg">
    <title> MiMBlog</title>
     <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">





</head>
<body class="Brad" style=" width: 100%; height: 100%; background-color: ghostwhite;" >
     <header>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="font-size: 10px;">
      <li class="nav-item " style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Mimblog.php"><h3><img src="blogo.jpg" style="border-radius: 6px; box-shadow: 0 15px 19px 0 rgba(0,0,0,0.98);">   |</h3><span class="sr-only">(current)</span></a>
      </li><br>
      <br><li class="nav-item " style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Mimblog.php"><h5>Home  |</h4><span class="sr-only">(current)</span></a>
      </li><br>
      <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Entertainment.php"><h5>Entertainment |</h1> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Art.php"><h5>Art  |</h1> <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Sport.php"><h5>Sport  |</h1> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="video.php"><h5>Videos |</h1><span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Advertise.php"><h5>Advertise |</h1><span class="sr-only">(current)</span></a>
      </li>
         <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <div>
         <?php
            error_reporting(0);
            session_start();

            if(!isset($_SESSION['user_login'])){ ?>
                
                <a class="nav-link" href="Login.php"> <h5> Log in |</h1><span class="sr-only">(current)</span></a>
              <?php 
              }

              $id = $_SESSION['user_login'];
    
               $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
               $select_stmt->execute(array(":uid"=>$id));
               $output = '';
               $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    
               if(isset($_SESSION['user_login']))
              {
                $output = '<a>'.$row['username'].'</a>';
                echo ('<a class="nav-link" href="user.php"><h5>'.$row['username'].  " | </h1></a>\n");}
                
                ?> 
           </div>
         
      </li>
      <li class="nav-item"style="margin-top: auto; margin-bottom: auto;">
        <a class="nav-link" href="Add Blog.php"><h5>Add Blog</h1><span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav><br>
<?php
    

    
 session_start();
    
 $id = $_SESSION['user_login'];
    
 $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
 $select_stmt->execute(array(":uid"=>$id));
 
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
 $outta = '';  
 if(isset($_SESSION['user_login']))
 { $outta = $row['username'];
  $into = $row['user_id']; }
 ?>

<?php

 $query = "
 SELECT * FROM adsuscribe
 WHERE name = '".$outta."'
 
 ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 $a = '';
 $b = '';
 $count = $statement->rowCount();
 
  foreach($result as $row)
  {
    $a .= $row['subs'];
    $b .= $row['number'];
   if($b == '65'){?>
       <div style="border-radius: 3px; background: magenta; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $a; ?></a></div></div><br><br>
   <?php }
   else if($b == '75'){?>
       <div style="border-radius: 3px; background: silver; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $a; ?></a></div></div><br><br>
   <?php }
   else if($b == '85'){?>
       <div style="border-radius: 3px; background: pink; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $a; ?></a></div></div><br><br>
   <?php }
   else if($b == '95'){?>
       <div style="border-radius: 3px; background: brown; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $a; ?></a></div></div><br><br>
   <?php }
  }  
 
  if($query = "
 SELECT * FROM suscribe
 WHERE name = '".$into."'
 
 "){

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';

 $cout = $statement->rowCount();
 
  if($cout == 0 && $count == 0){
       header('location: auth5.php');
    }
  
  
 foreach ($result as $row) 
 {
  $num .= $row['number'];
    $output .= $row['subs'];
    if($row['number'] == '25'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-dark" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none; "> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
   <?php }
    else if($row['number'] == '35'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-success" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
   <?php }
    else if($row['number'] == '45'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-primary" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
   <?php }
   else if($row['number'] == '55'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-danger" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>

   <?php }
   else if($row['number'] == '65'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-danger" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
  
   <?php }
   else if($row['number'] == '75'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-secondary" style="width: 20rem; color: silver; border-color: silver;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
  
   <?php }
   else if($row['number'] == '85'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-danger" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
  
   <?php }
   else if($row['number'] == '95'){?>
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        <h5 >You are currently subscribed to  <br><br><button class="btn btn-outline-dark" style="width: 20rem;"><b ><?php echo $output;?></b></button></h5><br>
        <button class="btn btn-info"><a href="unsubs.php" style="color: white; text-decoration: none;"> Unsubscribe</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>
  
   <?php }

   
   

 }
}



 ?>

 
 </div>
  </div>
 </div> <br><br>
  

<br><br><footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>
</div>
</body>