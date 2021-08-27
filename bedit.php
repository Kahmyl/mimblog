<?php
require_once "pdo.php";
session_start();
$id = $_SESSION['user_login'];
    
$select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:uid");
$select_stmt->execute(array(":uid"=>$id));
$statusMsg = '';
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_SESSION['user_login']))
{ 
     $outta = $row['username']; 
     $ditto = $row['email'];
     $into = $row['user_id'];
}

$post_id = $_GET["id"];
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

if(isset($_POST['submit']))
{
    $title =$_POST["title"];
    $body =$_POST["body"];
    $category =$_POST["category"];
    if(!empty($title) AND !empty($body) AND !empty($category))
    {
        if(isset($_FILES['image']))
        {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);
    
            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true)
            {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true)
                {
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"images/".$new_img_name))
                    {
                        $update_stmt = $pdo->prepare("UPDATE post SET title = :title, body = :body, category = :category, user_id = :user_id, image = :image WHERE post_id = '".$post_id."' ");
                        if ($update_stmt->execute(array(":title"=>$title, ":body"=>$body,  ":category"=>$category, ":user_id"=>$into, ":image"=>$new_img_name))) 
                        {
                            $_SESSION["success"] = "Added";
                            if ($category == 1) 
                            {
                                header('location: Mimblog.php');
                            }
                            elseif ($category == 2) 
                            {
                                header('location: Entertainment.php');
                            }
                            elseif ($category == 3) 
                            {
                                header('location: Art.php');
                            }
                            elseif ($category == 4) 
                            {
                                header('location: Sport.php');
                            }
                            
                        }
                    }
                    else 
                    {
                        $_SESSION["error"] = "Something went wrong";
                    }
                }
                else 
                {
                    $_SESSION["error"] = "Please upload an image file - jpeg, png, jpg";
                }
            }
            else 
            {
                $_SESSION["error"] = "Please upload an image file - jpeg, png, jpg";
            }
        }
        else 
        {
            $_SESSION["error"]="error1";
        }
    }
    elseif(empty($title) AND empty($body) AND empty($category))
    {
        $_SESSION["error"] = "All input fields are required!";
    }
    elseif (empty($title)) 
    {
        $_SESSION["error"] = "title field required";
    }
    elseif (empty($body)) 
    {
        $_SESSION["error"] = "Description input field is required!";
    }
    elseif (empty($category)) 
    {
        $_SESSION["error"] = "Category input field is required!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://localhost/Blog/logo.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Mimblog</title>
</head>
<body style="background: grey;">
    <div class="row">
        <div class="container d-flex justify-content-center" style="width: 45rem; padding-top: 30px; padding-bottom: 30px;">
            <div class="card" >
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Edit post</span>
                        </div>
                        <div class="col-md-6 text-right">
                            <i class="fa fa-edit"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
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
                        <div class="form-group" >
                            <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $title;?>">
                        </div>
                        <div class="form-group" >
                            <textarea name="body" id="body" cols="100" rows="10" class="form-control" placeholder="Description" ><?php echo $body;?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" value="<?php echo $Img;?>" >
                            <img src="images/<?php echo $Img;?>" alt="" width="120">
                        </div>
                        <div class="form-group" >
                            <select name="category" id="category" class="form-control">
                                <?php
                                if ($category == 1) {
                                    echo'<option value="'.$category.'">Others</option>';
                                }
                                elseif ($category == 2) {
                                    echo'<option value="'.$category.'">Entertainment</option>';
                                }
                                elseif ($category == 3) {
                                    echo'<option value="'.$category.'">Art</option>';
                                }
                                elseif ($category == 4) {
                                    echo'<option value="'.$category.'">Sport</option>';
                                }
                                
                                ?>
                                <option value="1">Others</option>
                                <option value="2">Entertainment</option>
                                <option value="3">Art</option>
                                <option value="4">Sport</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" name="submit" id="submit" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>