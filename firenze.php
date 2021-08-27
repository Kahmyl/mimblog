<?php
require_once 'pdo.php';
session_start();

$cardMsg = '';
$expMsg = '';
$cvcMsg = '';
$success = '';
if(isset($_REQUEST['submit'])) {
	$cardnm =  strip_tags($_REQUEST["cardnm"]);
	$cardexp =  strip_tags($_REQUEST["cardexp"]);
	$cardcvc =  strip_tags($_REQUEST["cardcvc"]);

	if(empty($cardnm)){
       $cardMsg="x"; 
    }
    if(empty($cardexp)){
       $expMsg="x"; 
    }
    if(empty($cardcvc)){
       $cvcMsg="x"; 
    }
    else{
    	$select_stmt=$pdo->prepare("SELECT * FROM credit WHERE cardnm=:cardnm OR cardcvc=:cardcvc");
        $select_stmt->execute(array(':cardnm'=>$cardnm, ':cardcvc'=>$cardcvc));
        $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
        if($select_stmt->rowCount() > 0) {
        		if($cardcvc==$row["cardcvc"]){
        			$success = "success";
        			header("location: creditdone.php");
        		}
        		else{
        			$cvcMsg="x"; 
        		}
        	
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	    
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style type="text/css">
    	body{
	         background-color: #000;
        }
       .padding{

	            padding: 5rem !important;
        }
    </style>
</head>
<body>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
<div class="padding">
	<div class="row">
		<div class="container d-flex justify-content-center">
		    <div class="col-md-6 col-sm-8">
		    	<div class="card">
		    		<div class="card-header">
		    			<div class="row">
		    				<div class="col-md-6">
		    					<span>CREDIT CARD</span>
		    				</div>
		    				<div class="col-md-6 text-right" style="margin-top: -5px;">
		    					<img src="https://img.icons8.com/color/36/000000/visa.png">
		    					<img src="https://img.icons8.com/color/36/000000/mastercard.png">
		    					<img src="https://img.icons8.com/color/36/000000/amex.png">
		    				</div>
		    			</div>
		    		</div>

		    		<div class="card-body" style="height: 400px; padding: 4rem; padding-top: 2rem;">
		    			<span style="color: green ;  text-align: center; margin-top: auto; margin-bottom: auto;"><b><?php echo  $success;  ?></b></span>
		    			<form method="POST">
		    			   <div class="form-group">
		    				<label for="cc-number" class="control-label">CARD NUMBER</label>
		    				<div style="display: flex;">
		    				<input type="tel" id="cc-number" class="input-lg form-control cc-number"  autocomplete="cc-number" placeholder="1111 2222 3333 4444"  name="cardnm"> <span style="color: red ;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $cardMsg;  ?></b></span></div>
		    			   </div>
		    			   <div class="row">
		    			   	 <div class="col-md-6">
		    			   	 	<div class="form-group">
		    				      <label for="cc-exp" class="control-label">CARD EXPIRY</label>
		    				      <div style="display: flex;">
		    				      <input type="tel" id="cc-exp" class="input-lg form-control cc-exp"  autocomplete="cc-exp" placeholder="12 / 2020"  name="cardexp"><span style="color: red ;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $expMsg;  ?></b></span></div>
		    			        </div>
		    			   	 </div>
		    			   	  <div class="col-md-6">
		    			   	 	<div class="form-group">
		    				      <label for="cc-cvc" class="control-label">CARD CVC</label>
		    				      <div style="display: flex;">
		    				      <input type="tel" id="cc-cvc" class="input-lg form-control cc-cvc"  autocomplete="cc-cvc" placeholder="361"  name="cardcvc"><span style="color: red ;  margin-left: 3px; margin-top: auto; margin-bottom: auto;"><b><?php echo  $cvcMsg;  ?></b></span></div>
		    			        </div>
		    			   	 </div>
		    			   </div>
		    			   <div class="form-group">
		    			   	<label for="numeric" class="control-label">CARD HOLDER NAME</label>
		    			   	<input type="text" class="input-lg form-control "  name="name">
		    			   </div><br>
		    			   <div class="form-group">	
		    			     <input type="submit" name="submit" id="submit" class="btn btn-success btn-lg form-control" style="font-size: .8rem;" value="SUBMIT"/>
		    			   </div>  

		    			
		    			
		    				
		    				
		    			</form>
		    		</div>
		    	</div>
		    </div>	
		</div>
	</div>
</div>
<script type="text/javascript" src="firenze.js"></script>
</body>
</html>