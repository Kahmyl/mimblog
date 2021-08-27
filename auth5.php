<?php
 
    
 require_once 'pdo.php';
  
 
 ?> 
<?php
$errMsg = '';
$sucsMsg = '';
 session_start();
 if(!isset($_SESSION['user_login'])){ ?>
                
                <a class="nav-link" href="Login.php"> <h5> Log in</h1><span class="sr-only">(current)</span></a>
              <?php 
              }

              $id = $_SESSION['user_login'];
    
               $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
               $select_stmt->execute(array(":uid"=>$id));
               $output = '';
               $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    
               if(isset($_SESSION['user_login']))
              {
                $outta = $row['username'];
                $into = $row['user_id'];}

 if(isset($_REQUEST['submit'])) {
      $subs = strip_tags($_REQUEST["subs"]); 
      $number = strip_tags($_REQUEST["number"]); 

      if(empty($subs)){
          $errMsg="Please enter comment"; 
      }
      else if(!isset($_SESSION['user_login'])){
           $errMsg="You need to Log in";  
      }
      else
      {
        $insert_stmt=$pdo->prepare("INSERT INTO suscribe (name, number, subs) VALUES
                (:name,:number,:subs)");
          if($insert_stmt->execute(array(  
                                   ':name' => $into,
                                    ':number'=>$number, 
                                    ':subs'=>$subs))){
            $sucsMsg="Suscribed ";
            header('location: suscribed.php');
            
          }  
          else
          {
            $errMsg="You are already suscribed to a patner plan"; 
          }
      }
  }  
?>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg">
    <title> MiMBlog</title>
     <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css">
  
* {
  box-sizing: border-box;
}

/* Create three columns of equal width */
.columns {
  max-height: 15rem;
  float: left;
  width: 23.9%;
  padding: 10px;
  padding-left: 80px;


}

/* Style the list */
.price {

  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;

}

/* Add shadows on hover */
.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);
  padding-bottom: 0px;
}

/* Pricing header */
.price .header {
  
  color: white;
  font-size: 15px;
}

/* List items */
.price li {
  background: white;
  border-bottom: 1px solid #eee;
  padding: 15px;
  text-align: center;
}

/* Grey list item */
.price .grey {
  background-color: #eee;
  font-size: 20px;
}

/* The "Sign Up" button */
.button {
  background-color: #4CAF50;
  border-radius: 6px;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}
.button a{
  text-decoration: none;
}
/* Change the width of the three columns to 100%
(to stack horizontally on small screens) */
@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>


</head>
<body style="background: ghostwhite;">
 <?php
 
    
 require_once 'pdo.php';

if(isset($_REQUEST['search'])) {
       $q = strip_tags($_REQUEST["q"]);
       
    }  
 
 ?>


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
                $into = $row['user_id'];
                echo ('<a class="nav-link" href="user.php"><h5>'.$row['username'].  " | </h1></a>\n");}
                
                ?> 
           </div>
         
      </li>
      <li class="nav-item"style="margin-top: auto; margin-bottom: auto;"><h1>
        <div class="dropdown">
  <button class="btn btn-default dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Toggle Blogs
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="zak.php">Add Blogs</a>
    <a class="dropdown-item" href="zakedit.php">Edit Blogs</a>
    <a class="dropdown-item" href="zakdelete.php">Delete Blogs</a>
  </div></h3>
      </li>

    </ul>
    <?php if($_GET['q'] !== ''){  ?>

    <form action="searchtest.php" method="GET" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search">
      <button  class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search"> <i class="fa fa-search"></i></button>
    </form>
  </div>
</nav><br>
<?php

if (!isset($q)){
  echo "";
}else{
        $query = "
 SELECT * FROM search WHERE title LIKE '%$q%' OR firstp LIKE '%$q%'
 ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $count= $statement->rowCount();
 ?>
 <p><strong><?php echo $count; ?></strong> results found for '<?php echo $q; ?>'</p>
 <?php
 foreach ($result as $row) {
     $id = $row['id'];
     $title = $row['title'];
     $desc = $row['description'];
     $decide .= '
                 <div class="boggart">
                 <div class="vold" style="border-color: lightgrey; font-size: 300%;
                 font-family:arial; background: grey; color:white;" ></div> <br> <br>
                 <div class="vold" style="border-bottom: solid; border-color: lightgrey;">
                      <a href="'.$row['link'].'.php" style="color: black; text-decoration: none;">
                         <div class="row">
                            <div class="col-sm"> 
                               <div class="card" style="width: 20rem;">
                                  <img src="'.$row['imglink'].'" class="card-img-top" alt="..." height="230rem">
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">
                               <h5>'.$row['title'].'</h5>
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">'.$row['firstp'].'</div>
                            </div>
                         </div><br>
                      </a>
                 </div>
                 </div>
                 <br>
              ';
              echo $decide;
     
 }
}
}else{
   header('Location: Mimblog.php');
}
    ?><br><br>

<div class="" style =" border-bottom: solid; border-color: lightgrey; background:grey; color:white; font-size: 300%; font-family:arial;">
            <div style="margin-left: 5rem;"> Patner Subscriptions</div></div>
         </div><br><br> 
<center>           
<span style="color: red ; text-align: center; margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $errMsg;  ?></b></span> 
<span style="color: green ; text-align: center;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $sucsMsg;  ?></b></span></center> <br>
<div>
<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: black;">Hephaestus</li>
    <li class="grey">Free /Limited offer</li>
    <li>Advertise at $2</li>
    <li>10 posts/month</li>
    <li>2 days ads</li>
    <li>Free for 10months</li>
      <form method="POST" >
        <input type="text" name="subs" value="Hephaestus" hidden>
        <input type="tel" name="number" value="25" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: green;">Poseidon</li>
    <li class="grey">$ 4.99 / year</li>
    <li>Advertise at $5</li>
    <li>40 posts/month</li>
    <li>7 days ads</li>
    <li>Free for 10months</li>
      <form method="POST" >
        <input type="text" name="subs" value="Poseidon" hidden>
        <input type="tel" name="number" value="35" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: blue;">Zeus</li>
    <li class="grey">$ 9.99 / year</li>
    <li>Advertise at $12</li>
    <li>100 posts/month</li>
    <li>17 days ads</li>
    <li>Free for 10months</li>
      <form method="POST" >
        <input type="text" name="subs" value="Zeus" hidden>
        <input type="tel" name="number" value="45" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: Orange;">Ares</li>
    <li class="grey">$ 19.99 / year</li>
    <li>Advertise at $25</li>
    <li>250 posts/month</li>
    <li>30 days ads</li>
    <li>Free for 10months</li>
      <form method="POST" >
        <input type="text" name="subs" value="Ares" hidden>
        <input type="tel" name="number" value="55" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


<div class="" style =" border-bottom: solid; border-color: lightgrey; background:grey; color:white; font-size: 300%; font-family:arial;">
            <div style="margin-left: 5rem;"> Advertisement Subscriptions</div></div>
         </div><br><br> 
<center>           
<span style="color: red ; text-align: center; margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $errMsg;  ?></b></span> 
<span style="color: green ; text-align: center;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $sucsMsg;  ?></b></span></center> <br>
<div>
<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: magenta;">Hermes</li>
    <li class="grey">$ 3 / month</li>
    
    <li>2 days ads</li>
    <li>Available</li>
      <form method="POST" >
        <input type="text" name="subs" value="Hermes" hidden>
        <input type="tel" name="number" value="65" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: silver;">Artemis</li>
    <li class="grey">$ 8 / month</li>
    
    <li>7 days ads</li>
    <li>Available</li>
      <form method="POST" >
        <input type="text" name="subs" value="Artemis" hidden>
        <input type="tel" name="number" value="75" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: pink;">Aphrodite</li>
    <li class="grey">$ 18 / month</li>
    
    <li>17 days ads</li>
    <li>Available</li>
      <form method="POST" >
        <input type="text" name="subs" value="Aphrodite" hidden>
        <input type="tel" name="number" value="85" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>

<div class="columns" >
  <ul class="price" style="background-color: lightgrey; padding-bottom: 0px;">
    <li class="header" style="background: brown;">Hades</li>
    <li class="grey">$ 45 / month</li>
   
    <li>30 days ads</li>
    <li>Available</li>
      <form method="POST" >
        <input type="text" name="subs" value="Hades" hidden>
        <input type="tel" name="number" value="95" hidden><div style="padding: 15px; padding-bottom: 0px; text-align: center;"><input type="submit" name="submit" class="button" value="Subscribe"></div>
        
      </form>
  </ul>
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>
  
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

             