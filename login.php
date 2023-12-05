<?php 

include './includes/header.php'; 
?> 
<?php

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $employee_id = 0;
	$password = "";
  
    
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$employee_id = trim($_POST['employee_id']);
    $password = trim($_POST['password']);

    $value = true;
    if(!isset($employee_id)||trim($employee_id)==""){
        $message ="Employee ID is required";
        $employee_id = "";
        $valid = false;
    }
    if(!isset($password)||trim($password)==""){
        $message ="Password is required";
        $password = "";
        $valid = false;
    }





    $sql = "SELECT * FROM employee WHERE employee_id='$employee_id' AND password='$password'";

    $result = pg_query($conn,$sql);


    if(pg_num_rows($result)==1){
        $row = pg_fetch_assoc($result);
        if($row['employee_id']===$employee_id && $row['password']===$password){
            $_SESSION['employee_id'] =  $row['employee_id'];
            $_SESSION['employee_name'] = $row['first_name'];
            $_SESSION['manager'] = $row['is_manager'];
            header("Location: index.php");
           
           
        }
        else{
           
        }
    }
    else{
        $message = "Employee ID or Password is not correct";
    }
    
}
?>
<div class="main-content">
    <div class="container">
        <div>
        <h1><b>Employee Log In</b></h1>
        </div>
        
        <h2 id = "errors"> <?php echo $message; ?></h2>
<?php


?>
<div>
    <?php

?>
	<h3><?php echo $message; ?></h3>
<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Employee Login</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="number" id="employee_id" class="form-control" name="employee_id" value="<?php echo $employee_id; ?>" placeholder="Enter Employee ID" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="password" name="password" value="<?php echo $password; ?>" class="form-control" placeholder="Enter password" required>
    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
</form>
</div>
        
    </div>

</div>




<?php include './includes/footer.php'; ?>