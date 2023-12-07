<?php

include "./includes/header.php";
?>

<?php
$message = "";
if(! isset($_SESSION['employee_id'])) 
{
	Header("Location: login.php");
}


$qty = 1;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$gameid = 0;
	$price = 0;
    $prodid = "";
	

}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$gameid = trim($_POST['gameID']);
	$price = trim($_POST['price']);
    $type = trim($_POST['type']);
    $prodid= trim($_POST['productid']);


	// Validate the form data
	$valid = true;
	

	
	if(!isset($gameID)||trim($gameID)==""){
		$message ="Game ID is required";
		
		$valid = false;
	}
	if(!isset($type)||trim($type)==""){
		$message ="Type of sell is required";
	
		$valid = false;
	}
	if(!isset($price)){
		$message ="Price of game is required";
	
		$valid = false;
	}
	if(!isset($prodid)){
		$message ="Product ID is required";
	
		$valid = false;
	}
    if(!is_numeric($prodid)){
        $message = "Product ID must be numeric";
        $valid = false;
        
    }
    if(!is_numeric($gameid)){
        $message = "Game ID must be numeric";
        $valid = false;
        
    }
  

    $math = 0;
    $conditionmath = 0;
    $finalmath = 0;
    $math = $price * 0.25;

    if($condition == 'Okay'){
	$conditionmath = $math * 0.10;
    $finalmath = $math - $conditionmath;
	}
    if($condition == 'Good'){
    $conditionmath = $math * 0.05;
    $finalmath = $math - $conditionmath;
        }

   
    $date = date("Y-m-d");

    $sql = "INSERT INTO games (title,condition,platform,in_stock,price)";
        $sql .= "VALUES ('$title','$condition','$platform','Yes','$finalmath')";
        $sql2 = "INSERT INTO transactions (date,transaction_type,price)";
        $sql2 .= "VALUES ('$date','-','$finalmath')"; 
        $sql3 = "INSERT INTO product (product_id,name_of_product,product_type,price)";
        $sql3 .= "VALUES ('$prodid','$title','game','$finalmath')";
        $sql4 = "INSERT INTO invoice_item (product_id,order_date,item_qty)";
        $sql4 .= "VALUES ('$prodid','$date','$qty')";
	
	

	


        if ($valid) {
            if (pg_query($conn, $sql)) {
                if (pg_query($conn, $sql2)) {
                    if (pg_query($conn, $sql3)) {
                        if (pg_query($conn, $sql4)) {
                            $message = "The game was successfully processed!";
                        }
                    }
                }
                
                
            } 
        }

}
?>
<div class="main-content">

    <div class="container">
        <h1><b>Buy Page</b></h1>
		<h2 id = "errors"> <?php echo $message; ?></h2>
        
 <form  method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
 <div class="form-group">
	 <label for="title">Enter Title:</label>
	 <input class="form-control" name="title"  placeholder="Enter Game Title" type="text">
 </div>
 <div class="form-group">
	 <label for="platform">Platform of Game:</label>
	 <input class="form-control" name="platform"  placeholder="Enter Platform" type="text">
 </div>
 <div class="form-group">
	 <label for="dob">Price of Game:</label>
	 <input class="form-control" name="price"  placeholder="Enter Price" type="number" step="any">
 </div>
 <div class="form-group">
	 <label for="adsress">Condition:</label>
	 <input class="form-control" name="condition"  placeholder="'Okay' - 'Good' - 'Perfect'" type="text">
 </div>
 <div class="form-group">
        <label for="productid">Product ID:</label>
        <input class="form-control" name="productid" placeholder="Enter sequence of numbers" type="number">
    </div>
 
 
 

 <button class="btn btn-primary" type="submit">Process</button>
</form>

<a href="https://www.pricecharting.com/" target="_blank">
  <button class="btn btn-primary" type="button">Online Market</button>
</a>
   
    </div>
</div>






<?php
include "./includes/footer.php";
?> 