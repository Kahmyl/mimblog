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
        <a class="nav-link" href="zak.php"><h5>Add Blog</h1><span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button style="width: 35px; height: 35px; border-radius: 50%;" class="btn btn-outline-success my-2 my-sm-0" type="submit"> <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg"></button>
    </form>
  </div>
</nav><br>
<center>
<b  style="font-size: 3rem; text-align:center;">Edit Profile</b><br><br><br>
</center>
<?php
 
    

 error_reporting(0);  
 $id = $_SESSION['user_login'];
    
 $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
 $select_stmt->execute(array(":uid"=>$id));
 
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
 $outta = '';  
 if(isset($_SESSION['user_login']))
 { $outta = htmlentities( $row['username']); 
   $ditto =  htmlentities($row['email']);
   $into =  htmlentities($row['user_id']);} 
 
 ?> 
<?php
    session_start();

    if(isset($_REQUEST['submit'])) {
      $username = strip_tags($_REQUEST["username"]);
      $user_idd = strip_tags($_REQUEST['user_id']); 
      

      if(empty($username)){      
        $_SESSION["error"]="Please enter username or email"; 
      }
      else
      {
        try
        {
          if(!isset ($_SESSION["error"])) {
            $update_stmt=$pdo->prepare("UPDATE users SET username = :username WHERE user_id = :user_id");
            if($update_stmt->execute(array( ':username' =>$username,
                                    ':user_id'=>$user_idd))){
                 
               
                  header( 'location: user.php');
                  return;
                }else{
                  $_SESSION["error"]="Email or Username already exists";
                  }
                
          }
          else{
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
 <?php
// Include the database configuration file

$statusMsg = '';

// File upload path

$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["upload"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $updt_stmt=$pdo->prepare("UPDATE users SET file_name = :fileName WHERE user_id = :user_id  ");
             if($updt_stmt->execute(array( 
                                    ':fileName'=>$fileName,
                                    ':user_id' =>$into))){
             $statusMsg = " Image ".$fileName. "  uploaded ";
           
             }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}elseif($_POST["upload"] && empty($_FILES["file"]["name"])){
    $statusMsg = 'Please choose an image to upload';
}

$success = '';
if (isset($_POST['delete'])) {
    $sql = "UPDATE users SET file_name = '' WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':user_id' => $into));
    $success = 'Image removed';
    
    
}
?>
<center>

<?php  



  $query = "SELECT * FROM users WHERE user_id ='".$into."' ";

 $statement = $pdo->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();
 $output= '';
 $count = $statement->rowCount();
 if($count == 0){?>
       <img src="Profile2.jpg" alt="" class="profile_pic" style="width: 170px;height: 170px;margin-right: 5px;float: center;border-radius: 50%;"><br><br>
<?php }
 if($count > 0){
    foreach ($result as $row) 
    {
       $imageURL = 'uploads/'.$row["file_name"];
       $output .= '<img src=" '.$imageURL. '" alt="" style="width: 170px; height: 170px; margin-right: 5px; float: center; border-radius: 50%;" /><br><br>';
       $id = $row['id']; 
       if($row['file_name'] != ''){
        echo $output;
       }
       if($row['file_name'] == '')  {?>
        <img src="Profile2.jpg" alt="" class="profile_pic" style="width: 170px;height: 170px;margin-right: 5px;float: center;border-radius: 50%;"><br><br>
      <?php }           
    }
 
    
}
               
?>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<form action="editprofile.php" method="post" enctype="multipart/form-data">
    
    <div align="center" class="form-group container " style="display: flex; margin-left:20rem;" >
     <span class="btn btn-secondary">Select Image from File:</span>   
    <input type="file" name="file"  class="form-control " id="customFile"  style="height: 2.8rem; max-width: 30rem;" >
     
    </div>
    <input type="submit" name="upload" value="Upload" class="btn btn-outline-success">
    
</form> 

<?php
echo $statusMsg;
?>
<br><form method="POST">
    
           
            <input type="submit" name="delete" value="Remove Image" class="btn btn-outline-danger" style="float: center; ">
</form>
</center>         
               

 

<head>
 <link rel="stylesheet" type="text/css" href="MimBlog.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 </head>   
<center>
	 
	
	<?php
    if ( isset($_SESSION["error"]) ) {
        echo ('<p style="color:red; text-align:center;" >'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
    if ( isset($_SESSION["success"]) ) {
        echo ('<p style="color:white; text-align:center;">'.$_SESSION["success"]."</p>\n");
        unset($_SESSION["success"]);
    }
?>
    <div class="container">	
	<form method="POST">
		<div class="form-group">
			<input style=" max-width: 55rem; border-color: white; border-bottom: 0.5px solid black;" type="text" name="username" value="<?php echo $outta; ?>"  class="form-control">
		</div><br>
		<div class="form-group">
			<input style=" max-width: 55rem;" type="hidden" name="user_id" value="<?php echo $into; ?>"  class="form-control">
		</div>
</center><br>
        <div class="container">	
		<div class="form-group">
			<input style=" max-width: 55rem; margin-left: 7rem;"  type="submit" name="submit" value="Update"  class="btn btn-outline-info">
		</div>
		</div>	
	</form>
	</div><br><br><br>
