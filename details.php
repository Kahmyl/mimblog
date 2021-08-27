
 <?php
 
    
 require_once 'pdo.php';

if(isset($_REQUEST['search'])) {
       $q = strip_tags($_REQUEST["q"]);
       
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





</head>
<body class="Brad" style=" width: 100%; height: 100%">
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
    <a class="dropdown-item" href="bpost.php">Add Blogs</a>
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
                      <a href="details.php?id='.$post_id.'" style="color: black; text-decoration: none;">
                         <div class="row">
                            <div class="col-sm"> 
                               <div class="card" style="width: 20rem;">
                                  <img src="'.$row['image'].'" class="card-img-top" alt="..." height="230rem">
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">
                               <h5>'.$row['title'].'</h5>
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">'.$row['body'].'</div>
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
    ?>
<div style="margin-left:auto; padding-right: 20px;" >
<?php
  $query = "SELECT * FROM users WHERE  user_id ='".$into."' ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 $count = $statement->rowCount();
 
 if($count > 0){
    foreach ($result as $row) 
    {
       $imageURL = 'uploads/'.$row["file_name"];
       $output .= '<img align="right" src=" '.$imageURL. '" alt="" style="width: 49px; height: 49px;   border-radius: 50%;" />';
       $id = $row['id']; 
       if($row['file_name'] != ''){
        echo $output;
       }
       if($row['file_name'] == '')  {?>
        <img align="right" src="Profile2.jpg" alt="" class="profile_pic" style="width: 49px;height: 49px;border-radius: 50%;">
      <?php }           
    }
 
    
}
?>
</diV><br><br>
<?php


$post_id = $_GET["id"];

if (isset($_POST['delete']) && isset($_POST['post_id'])) {
	$sql = "DELETE  FROM post WHERE post_id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':id' => $post_id));
	header('Location: Mimblog.php');
}

$query = "
 SELECT * FROM post WHERE post_id = '".$post_id."'
 ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 foreach ($result as $row) {
  $key = $row['user_id'];
    $Img = $row['image'];
    $title = $row['title'];
    $body = $row['body'];
    $category = $row['category'];
 }
 ?> <?php
 
 $query = "
 SELECT * FROM users WHERE user_id = '".$key."'
 ";
  $statement = $pdo->prepare($query);

  $statement->execute();
  $result = $statement->fetchAll();
  $output= '';
 foreach ($result as $row) {
   $imageURL = 'uploads/'.$row["file_name"];
  $pname = $row['username'];
  if($row['file_name'] == ''){
    $profimg = "profile2.jpg";

  }
  else if($row['file_name'] != ''){
    $profimg = $imageURL;
    
    
  }
  $gig = $row['file_name'];
 }

  $query = "
 SELECT * FROM post WHERE post_id = '".$post_id."'
";

$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$utput= '';
foreach ($result as $row) {
       $cast = $row['post_id'];
       if($into == $row['user_id']){
           $action = '
           <div style="display: inline-flex; text-align:center;">
           <div>
           <a class="btn btn-outline-info" style="display: inline-flex; margin-left:100px;" href="bedit.php?id='.$post_id.'"><div style="display: inline-flex;"><i class="fa fa-edit fa-2x"></i><span style="padding-top:2px;">Edit</span></div></a>
           </div>

           <form method="post" >
           <div style="display: inline-flex; margin-left:100px;">
           <input type="hidden" name="post_id" value="'.$post_id.'" >
           <button style="display: inline-flex;" class="btn btn-outline-danger" type="submit" name="delete"><i class="fa fa-times fa-2x "></i><span style="padding-top:3px; padding-left:4px;">Delete</span></button> 
           </div>
           </form> 
                            
           </div> 
           ';
       }
 $utput .= '<div class = vans>
                <div class="">
                  <div class="card-body">
                    <h3 class="card-title" style="margin-left: 10px;">'.$row['title'].'</h3>
                     <div style="display: flex; color: grey;">
                     <b style="margin-left: 10px; "  > 
                     -  <img src="'.$profimg.'" alt="Person" width="96" height="96" style="border-radius: 50%; width: 49px; height: 49px;"><span style="margin-left: 5px;">'.$pname.'</span> <span style="margin-left: 2rem;"> '.$row['created_at'].'</span>
                     </div> <br>  
                    </b>
                    '.$action.'
                  </div>
                    <img src="images/'.$row['image'].'" class="card-img-top" alt="..."><br><br>
                     <p class="card-text">'.$row['body'].'</p>
                </div>    
             </div>
             ';
}
echo $utput;
?>
<p><?php $result['created_at'];?></p>
<?php
 
  $query = "
 SELECT * FROM post WHERE post_id != '".$post_id."' ORDER BY created_at ASC
 ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 foreach ($result as $row) {
  $key = $row['user_id'];
    $Img = $row['image'];
    $title = $row['title'];
    $body = $row['body'];
 }
 ?> <div class="boggart">
  <div class="vold" style="border-color: lightgrey; font-size: 300%; font-family:arial; background: grey; color:white;" >
                 <div style="margin-left: 10px;">Updates</div>
                 </div></div> <br> <br><?php
 
 $query = "
 SELECT * FROM users WHERE  user_id = '".$key."'
 ";
  $statement = $pdo->prepare($query);

  $statement->execute();
  $result = $statement->fetchAll();
  $output= '';
 foreach ($result as $row) {
  $pname = $row['username'];
 }

  $query = "
 SELECT * FROM post WHERE category = '".$category."' AND post_id != '".$post_id."' ORDER BY created_at ASC";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 foreach ($result as $row) {
  
  $output .= '<div class="boggart">
                 
                 <div class="vold" style="border-bottom: solid; border-color: lightgrey;">
                      <a href="details.php?id='.$post_id.'" style="color: black; text-decoration: none;">
                         <div class="row">
                            <div class="col-sm"> 
                               <div class="card" style="width: 20rem;">
                                  <img src="images/'.$row['image'].'" class="card-img-top" alt="..." height="230rem">
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">
                               <h5>'.$row['title'].'</h5>
                               </div>
                            </div>
                            <div class="col-sm">
                               <div style="border-radius: 3px; background: white; width: 20rem;">'.$row['body'].'</div>
                            </div>
                         </div><br>
                      </a>
                 </div><br>
              </div>';
 }
echo $output;
  ?>
  <a href="" style="color: white; text-decoration: none;"><div style="border-width: 10em; max-width: 55rem; margin-left: auto; margin-right: auto; background:grey;  border-radius: 3px;"><h2 style="text-align: center;">Load more...</h2></div></a><br><br><br><br><br><br>
  <footer style="border-width: 10px; background: lavender;">


     <a href="">MiMblog</a>   |
     <a href="">Terms of service</a>  |
     <a href="">Privacy policy</a>  |
     <a href="">Code of conducts</a><br><br>
     © 2013-2020 Verizon Media. All rights reserved. Powered by WordPress VIP.
</footer>
  
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
</body>