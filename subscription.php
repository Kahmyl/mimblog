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
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
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
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="font-size: 10px;">
      <li class="nav-item ">
        <a class="nav-link" href="Mimblog.php"><h2><button style =" border-radius: 6px; background: ;"><img src="http://localhost/Blog/blogo.jpg" ></button>   |</h3><span class="sr-only">(current)</span></a>
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
</nav><br><br><br>  
<?php
  $connect = new PDO('mysql:host=localhost;dbname=misc', 'root', ''); 
 ?> 

 <?php
 session_start();


              $id = $_SESSION['user_login'];
    
               $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
               $select_stmt->execute(array(":uid"=>$id));
               $output = '';
               $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    
               if(isset($_SESSION['user_login']))
              {
                $outta = '<a>'.$row['username'].'</a>';}
 if(isset($_REQUEST['submit'])) {
      $subs = strip_tags($_REQUEST["subs"]);
     

 if(empty($comment)){
  $_SESSION["error"]="Please enter comment"; 
  }
  else if(!isset($_SESSION['user_login'])){
  $_SESSION["error"]="you need to Log in";  
  }   
  else
     {
       try
       {
         if(!isset ($_SESSION["error"])) {
          $insert_stmt=$connect->prepare("INSERT INTO comment4 (parent_comment_id, comment, name) VALUES
                (:parent_comment_id,:comment,:name)");
          if($insert_stmt->execute(array(  
                                   ':parent_comment_id' => $_POST["comment_id"],
                                    ':comment'=>$comment, 
                                    ':name'=>$outta))){
            $_SESSION["success"]="Comment Added ";
            header("location: airwallex.php");
          }  
         }   
       }
       catch(PDOException $e)
       {
       $e->getMessage();
       }
     }
 }    
 ?>  