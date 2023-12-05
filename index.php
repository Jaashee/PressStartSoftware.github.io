<?php 
include './includes/header.php'; 



if(! isset($_SESSION['employee_id'])) {
    Header("Location: login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$first_name = "";
    $last_name = "";
	$password = "";
	$cpassword = "";

}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email_address = trim($_POST['client_email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$cpassword = trim($_POST['confirmpassword']);


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
        <h1>Employee Page</h1>
        <h1>Currently logged in: <?php echo $_SESSION['employee_name']; ?></h1>

        <form  method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
 <div class="form-group">
	 <label for="first_name">First name:</label>
	 <input class="form-control" value="<?php $first_name?>" name="first_name" placeholder="Enter first name" type="text">

 </div>
 <div class="form-group">
	 <label for="last_name">Last name:</label>
	 <input class="form-control" value="<?php $last_name?>" name="last_name" placeholder="Enter last name" type="text">

 </div>
 <div class="form-group">
	 <label for="last_name">Password:</label>
	 <input class="form-control" value="<?php $password?>" name="password" placeholder="Enter a password" type="text">

 </div>
 <div class="form-group">
	 <label for="confirmpassword">Confirm Password:</label>
	 <input class="form-control" value="<?php $confirmpassword?>" name="confirmpassword" placeholder="Confirm your password" type="text">

 </div>

 <button class="btn btn-primary" type="submit">Add Employee</button>
</form>
    </div>
</div>

<?php include './includes/footer.php';
   









