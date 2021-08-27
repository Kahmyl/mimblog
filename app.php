<center>
 <h2>
 <?php
    
 require_once 'pdo.php';
    
 session_start();

 if(!isset($_SESSION['user_signup'])) //check unauthorize user not access in "welcome.php" page
 {
  header("location: Login.php");
 }
    
 $id = $_SESSION['user_signup'];
    
 $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
 $select_stmt->execute(array(":uid"=>$id));
 
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    
 if(isset($_SESSION['user_signup']))
 {
 ?>
  Welcome,
 <?php
   echo ('<a style="text-decoration:none; color:black;" href="user.php">'.$row['username']."</a>\n");
 }
 ?>
 </h2>
 
 
  
</center>