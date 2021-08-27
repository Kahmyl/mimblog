<?php
require_once 'pdo.php';
    
session_start();
error_reporting(0);
 
  $id = $_SESSION['user_login'];
    
 $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
 $select_stmt->execute(array(":uid"=>$id));
 
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
 $outta = ''; 
 if(!isset($_SESSION['user_login'])){ ?>
       <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg">
    <title> MiMBlog</title>
     <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
   <br><br><br><br><br><br><br> <body style="background: ghostwhite;">        
       <center >
    <div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
    <div class="container">
      <div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
        <div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
        
        <button class="btn btn-dark"><a href="login.php" style="color: white; text-decoration: none;"> Login</a></button><br><br>
        </div>
      </div>
      </div>
      </div>
  </center>     
  </body> 
 <?php   }   
  else if(isset($_SESSION['user_login']))
 { $outta = $row['username']; 
   $ditto = $row['email'];
    $into = $row['user_id'];  
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg">
    <title> MiMBlog</title>
     <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-color:ghostwhite;">
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
        <a class="nav-link" href="subsn.php"><h5>Subscriptions |</h4><span class="sr-only">(current)</span></a>
     

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav><br> 
 <br><br>
 <div class="container">
  <div class="card" style="max-width: 65rem; margin-left:auto; margin-right: auto; box-shadow: 0 8px 10px 0 rgba(0,0,0,0.98);">
 <div style="margin-left: 40px; margin-right: 40px;">
 
 <h2 style =" font-size: 25px; color: black;">
 
 <br><div>
 <?php
   echo ('Hi, '.$outta);

 ?>
</div><br>
  <?php  



  $query = "SELECT * FROM users WHERE user_id ='".$into."' ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 $count = $statement->rowCount();
 if($count == 0){?>
       <img src="Profile2.jpg" alt="" class="profile_pic" style="width: 49px;height: 49px;margin-right: 5px;float: center;border-radius: 50%;">
<?php }
 if($count > 0){
    foreach ($result as $row) 
    {
       $imageURL = 'uploads/'.$row["file_name"];
       $output .= '<img src=" '.$imageURL. '" alt="" style="width: 49px; height: 49px; margin-right: 5px; float: center; border-radius: 50%;" />';
       
       if($row['file_name'] != ''){
        echo $output;
       }
       elseif($row['file_name'] == '')  {?>
        <img src="Profile2.jpg" alt="" class="profile_pic" style="width: 49px;height: 49px;margin-right: 5px;float: center;border-radius: 50%;">
      <?php }           
    }
 
    
}
               
?>
 </h2><br><br>
 
 <div style="color: lightgrey;  border-bottom:0.5px solid; border-color: lightgrey; display: flex; ">
   <div style="font-size: 20px;">Account details</div>
   <div style=" text-align: right; margin-left: auto;"><a href="editprofile.php" style="color: grey; text-decoration: none; text-align: right;  font-size:15px; margin-bottom: auto; margin-top: auto; "> Edit profile <i class="fa fa-edit"></i></a></div>
</div><br>
<p>Name  <c style="margin-left: 2rem;" ><?php echo $outta;?></c></p>
<p>Email <a href="" style="margin-left: 2rem; color: grey; text-decoration: none;" ><?php echo $ditto;?></a></p><br>
 
 <?php   
  
 
 ?>
 
 <div style="color: lightgrey;  border-bottom:0.5px solid; border-color: lightgrey;font-size: 20px; display: flex; ">
   <div> Status</div>
 </div><br>
 <div>
 
<?php
$query = "
 SELECT * FROM suscribe
 WHERE name = '".$into."'
 
 ";
 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
  $count = $statement->rowCount();
  if(isset($_SESSION['user_login']) && $count == 0 ){?>
    <div style="color: grey;"><b><i>User</i></b></div><br><br>
<?php       
   }
  foreach ($result as $row) 
 {
   if($row['number'] == '25'){?>
    <div><b><i>Partner</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '35'){?>
    <div style="color: green;"><b><i>Partner</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '45'){?>
    <div style="color: blue;"><b><i>Partner</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '55'){?>
    <div style="color: orange;"><b><i>Partner</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '65'){?>
    <div style="color: magenta;"><b><i>User</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '75'){?>
    <div style="color: silver;"><b><i>User</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '85'){?>
    <div style="color: pink;"><b><i>User</i></b></div><br><br>
<?php       
   }
   elseif($row['number'] == '95'){?>
    <div style="color: brown;"><b><i>User</i></b></div><br><br>
<?php       
   }
   
 }
?>

 </div>
 <div style="color: lightgrey;  border-bottom:0.5px solid; border-color: lightgrey;font-size: 20px; display: flex; ">
   <div> Subscriptions</div>
 </div><br>
 <?php

 $query = "
 SELECT * FROM suscribe
 WHERE name = '".$into."'
 
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
 if($cout == 0 && $count == 0){?>
       <div style="border-radius: 3px; background: red; "> <div style="color: white; margin-left: 10px;"><a href="Nosubscription.php" style="color: white; text-decoration: none;">No Subscription</a></div></div><br><br>
   <?php }
  
  
 foreach ($result as $row) 
 {
  $num .= $row['number'];
    $output .= $row['subs'];
    if($row['number'] == '25'){?>
       <div style="border-radius: 3px; background: black; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $output; ?></a></div></div><br><br>
   <?php }
    else if($row['number'] == '35'){?>
       <div style="border-radius: 3px; background: green; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $output; ?></a></div></div><br><br>
   <?php }
    else if($row['number'] == '45'){?>
       <div style="border-radius: 3px; background: blue; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $output; ?></a></div></div><br><br>
   <?php }
   else if($row['number'] == '55'){?>
       <div style="border-radius: 3px; background: orange; "> <div style="color: white; margin-left: 10px;"><a href="" style="color: white; text-decoration: none;"><?php echo $output; ?></a></div></div><br><br>
   <?php }

   
   

 }
}



 ?>
 
 <div style="margin-left: auto; display: flex;"> <button class="btn btn-secondary" style="margin-left: auto;"><a href="logout.php" style = " color:white; text-decoration: none; margin-left: auto;">Logout</a></button></div><br><br><br><br>
 
 </div>
  </div>
 </div> <br><br>
  
<?php
    
 }            
            

 ?>

<br><br><footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>
</div>
</body>
