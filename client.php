<?php
$title = "WEBD3201 Salespeople";
include "./includes/header.php";
?>

<?php
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$email_address = "";

}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email_address = trim($_POST['client_email']);


	// Validate the form data
	$valid = true;
	if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		$valid = false;
		$message = "Client email must be formatted correctly";
	}

	$query = pg_query($conn,"SELECT * FROM  client WHERE client_email= '$email_address'");
	if(pg_num_rows($query)>0)
	{
		$message = "Email id already use";
		$valid = false;
	}
	else{

	
	// If the form data is valid, insert the new salesperson user into the database
	$sql = "INSERT INTO client (client_email)"; 
	$sql .= "VALUES ('$email_address')";

	if ($valid) {
		if (pg_query($conn, $sql)) {
			
			$message = "The client email was successfully registered!";
		} else {
			
		}
	}
}
}
?>
<div class="main-content">
    <div class="container">
        <h1><b>Client Page</b></h1>
		<h2 id = "errors"> <?php echo $message; ?></h2>
        <?php
        display_form(
	array(
		array(
			"type" => "email",
			"name" => "client_email",	
            "value" => $email_address,
			"label" => "Client Email"
		),

	)
);
  ?>    
    </div>
</div>





<?php
include "./includes/footer.php";
?> 