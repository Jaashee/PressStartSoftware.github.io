<?php include './includes/header.php'; ?> 
<?php
require("./includes/constants.php");
require("./includes/db.php");
$message = "";
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  
    //making php variables into from what the user inputs
        $employee_id =trim($_POST['inputEmployeeId']);
        $password=trim($_POST['inputPassword']);
        //creating time variables to get the current date
        $today = date("Ymd");
        $now = date("Y-m-d G:i:s");
    //opening the txt file and writing the current date
     
        //creating a php variable that retrieves the email address and password
        $sql ="SELECT * FROM employee WHERE employee_id= '".$employee_id."'AND password = '".$password."'";
    
    $results = pg_query($conn,$sql);
    $stmt1 = pg_prepare($conn, 'employee_retrieve', 'SELECT * FROM employee WHERE employee_id = $1 and password = $2');
    $results = pg_execute($conn,'employee_retrieve', array($employee_id, $password));
    //if email address and password are in the database then go to dashboard if not its incorrect
    if(pg_num_rows($results))
    {
     
        $employee_id = pg_fetch_result($results, 0, 'employee_id');
        $password = pg_fetch_result($results, 0, 'password');
    
        
        header("Location:index.php");
       
        ob_flush();
    }
    else{
        $message = "Employee ID or password are not valid";
    }
   
   
    
    }
?>
<div class="main-content">
    <div class="container">
        <h1>Employee Login</h1>
        <form class="form-signin" method="POST" action="<?php echo$_SERVER['PHP_SELF'] ?>">
    <h2><?php echo $message ?></h2>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmployeeId" class="sr-only">Employee ID</label>
    <input type="text" id="inputEmployeeId" name="inputEmployeeId" class="form-control" placeholder="Employee ID" required autofocus>
    <label for="inputPassword"  class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
    </div>
</div>

<?php include './includes/footer.php'; ?>