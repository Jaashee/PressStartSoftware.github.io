<?php include './includes/header.php'; ?> 
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = "";
    $price = 0;
    $qty = "";
    $message = "";
    $type = ";";
    
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $qty = trim($_POST['qty']);
    $type = trim($_POST['price']);
    $prodid = trim($_POST['productid']);
 
    
    
    
	//error checking
	$valid = true;
	if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		$valid = false;
		$message = "Client email not formatted correctly";
	}
  
    if(!isset($price)||trim($price)==""){
        $message ="The price of repair is required";
        $price = "";
        $valid = false;
    }
    if(!isset($console)||trim($console)==""){
        $message ="The name of console is required";
        $console = "";
        $valid = false;
    }
    if(!is_numeric($prodid)){
        $message = "Product ID must be a number";
        $prodid = "";
        $valid = false;
        
        }
        else{
            $query2 = pg_query($conn,"SELECT * FROM  product WHERE product_id= '$prodid'");
            if(pg_num_rows($query2)>0)
            {
              
                $message = "Product ID entered already exists";
                $valid = false;
            }
        }
    if(!is_numeric($employee_id)){
            $message = "Employee ID is required";
            $valid = false;
            
        }
   else{
    $query = pg_query($conn,"SELECT * FROM  employee WHERE employee_id= '$employee_id'");
    if(!(pg_num_rows($query)>0))
	{
       
		$message = "Employee ID does not exist";
        $valid = false;
	}
   }
	

	$date = date("Y-m-d");
	
	$sql = "INSERT INTO repair (employee_id,console,repair_date,repair_status,client_email)";
    $sql .= "VALUES ('$employee_id','$console','$date','ongoing','$email_address')";
    $sql2 = "INSERT INTO transactions (price,repair_date,transaction_type)";
    $sql2 .= "VALUES ('$price','$date','+')"; 
    $sql3 = "INSERT INTO product (product_id,price,name_of_product,product_type)";
    $sql3 .= "VALUES ('$prodid','$price','$console','console')";
    $sql4 = "INSERT INTO invoice_item (product_id,item_qty,order_date)";
    $sql4 .= "VALUES ('$prodid','1','$date')";
 

	if ($valid) {
		if (pg_query($conn, $sql)) {
            if (pg_query($conn, $sql2)) {
                if (pg_query($conn, $sql3)) {
                    if (pg_query($conn, $sql4)) {
                        $message = "The repair was successfully saved!";
                    }
                }
            }
			
			
		} 
	}

}
?>
<div class="main-content">
    <div class="container">
        <div width="400" class="form-styled">
        <h1><b>Product Sell Page</b></h1>
        <h2 id = "errors"> <?php echo $message; ?></h2>
<?php
        display_form(
	array(
		array(
			"type" => "text",
			"name" => "name",	
            "value" => $name,
			"label" => "Name of product"
		),
        array(
			"type" => "text",
			"name" => "price",	
            "value" => $price,
			"label" => "Priceg"
		),
    
    array(
        "type" => "text",
        "name" => "console",	
        "value" => $console,
        "label" => "Console Name"
    ),
    array(
        "type" => "text",
        "name" => "price",	
        "value" => $price,
        "label" => "Price of repair"
    ),
    array(
        "type" => "number",
        "name" => "productid",	
        "value" => $prodid,
        "label" => "Product ID"
    ),
	)
);
?>
</div>

<?php include './includes/footer.php'; ?>