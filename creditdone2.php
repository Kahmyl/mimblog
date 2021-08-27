
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
      $status = strip_tags($_REQUEST["status"]); 
      $regis = strip_tags($_REQUEST["regis"]); 

      if(empty($status)){
          $errMsg="Please enter comment"; 
      }
      
      else
      {
        $insert_stmt=$pdo->prepare("INSERT INTO regis (name, status, regis) VALUES
                (:name,:status,:regis)");
          if($insert_stmt->execute(array(  
                                   ':name' => $into,
                                    ':status'=>$status, 
                                    ':regis'=>$regis))){
            $sucsMsg="Suscribed ";
            header('location: adauth.php');
            
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





</head>
<body style="background: ghostwhite; box-shadow: 10px;">
     <header>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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
        <a class="nav-link" href="Advertise.php"><h5>Add Blog</h1><span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav><br><br><br>

	  <center>
    <span style="color: red ; text-align: center; margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $errMsg;  ?></b></span> 
    <span style="color: green ; text-align: center;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $sucsMsg;  ?></b></span></center> <br>
    </center>
    <center >
		<div style="margin-right: auto; margin-left: auto; margin-top: 3rem; margin-bottom: auto; max-width: 30rem">
		<div class="container">
			<div class="card" style="box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2);">
				<div style="margin-right: 10px; margin-top: 25px; margin-left: 10px; ">
				<h5>Your details have been added successfully, continue to subscription.</h5><br><br>
        <form method="POST">
				<input type="tel" name="status" value="200" hidden>
        <input type="text" name="regis" value="registered" hidden>
        <input type="submit" name="submit" class="btn btn-info" value="Continue"><br>
				</div>
			</div>
			</div>
			</div>
	</center>
	<footer style="border-width: 10px; background: lavender; position: fixed; bottom: 0; width: 100%; border-top: 0.5px solid lightgrey;">


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