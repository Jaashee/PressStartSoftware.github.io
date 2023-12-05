<?php 
include './includes/header.php'; 



if(! isset($_SESSION['employee_id'])) {
    Header("Location: login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$first_name = "";
    $last_name = "";
	$password = "";
	$confirmpassword = "";
	$phonenumber = "";
	$address = "";
	$manaager = "";
	$message = "";

}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email_address = trim($_POST['client_email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirmpassword = trim($_POST['confirmpassword']);
	$phonenumber = trim($_POST['phonenumber']);
	$address = trim($_POST['address']);
	$manager = trim($_POST['manager']);


	// Validate the form data
	$valid = true;
	if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		$valid = false;
		$message = "Client email must be formatted correctly";
	}

	if(!isset($email_address)||trim($email_address)==""){
		$errors.="Email is required"."<br/>";
		$email_address = "";
	
	}
	if(!isset($first_name)||trim($first_name)==""){
		$errors.="Email is required"."<br/>";
		$fname = "";
	
	}
	$query = pg_query($conn,"SELECT * FROM  employee WHERE client_email= '$email_address'");
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

		<div>
		<h2 id = "errors"> <?php echo $message; ?></h2>
		</div>

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
	 <input class="form-control" value="<?php $confirmpassword?>" name="confirmpassword" placeholder="Confirm password" type="text">

 </div>
 <div class="form-group">
	 <label for="phonenumber">Phone Number:</label>
	 <input class="form-control" value="<?php $phonenumber?>" name="phonenumber" placeholder="Enter Phone Number" type="text">

 </div>

 <div class="form-group">
	 <label for="address">Address:</label>
	 <input class="form-control" value="<?php $address?>" name="address" placeholder="Enter address" type="text">

 </div>
 <div class="form-group">
        <input name="manager" type="checkbox" value="manager">
        <label for="perfect">Manager?</label><br>
    </div>

 <button class="btn btn-primary" type="submit">Add Employee</button>
</form>
    </div>
</div>

<?php include './includes/footer.php';
   









