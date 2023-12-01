<?php include './includes/header.php'; ?> 
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $repair_status = "";
    $repair_id = 0;
    $message = "";
    
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$repair_id = trim($_POST['repair_id']);
    $repair_status = trim($_POST['repair_status']);
    
    $message = "";

   
    $numlength = strlen((string)$repair_id);

	//error checking
	$valid = true;

 
   
     if(!is_numeric($repair_id)){
        $message = "Repair ID is required";
        $valid = false;
        
    }
    else{
        if(!(pg_num_rows($query)>0)){
            $query = pg_query($conn,"SELECT * FROM  repair WHERE repair_id= '$repair_id'");
            $message = "Repair ID does not exist";
            $valid = false;
        
            }
    }
    
      if(!($repair_status == "complete"|| $repair_status == "ongoing")){
        $message ="Repair Status can only be 'complete' or 'ongoing'";
        $repair_status = "";
        $valid = false;
    }
    
   
	


	
	$sql = "UPDATE repair ";
    $sql .= "SET repair_status = ('$repair_status')";
    $sql .= "WHERE repair_id = $repair_id";

 

	if ($valid) {
		if (pg_query($conn, $sql)) {
         
			$message = "Repair status successfully changed!";
			
		} 
	}

}
?>
<div class="main-content">
    <div class="container">
        <div>
        <h1><b>Repair Status Page</b></h1>
        <a href="repair.php">
        <i class="fa-solid fa-arrow-left"></i>
                    <span class="nav-item">Back to Repair Page</span>
                    
                   
                </a>
        </div>
        
        <h2 id = "errors"> <?php echo $message; ?></h2>
<?php


?>
<div>
    <?php
display_form(
	array(
		array(
			"type" => "number",
			"name" => "repair_id",	
            "value" => $repair_id,
			"label" => "Repair ID"
		),
    array(
        "type" => "text",
        "name" => "repair_status",	
        "value" => $repair_status,
        "label" => "Repair Status"
    ),
	)
);
?>
</div>
        
    </div>

</div>

<?php include './includes/footer.php'; ?>