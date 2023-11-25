<?php include './includes/header.php'; ?> 
<?php 
require("./includes/constants.php");
require("./includes/db.php");

$email_address="";
$error="";
$message="";
?>

<div class="main-content">
    <div style="text-align:center" class="clientpage">
        <h1>Client Page</h1>

      <?php 
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email_address =trim($_POST['input_email']);
     

     
    

    if($error=="")
    {
    $conn =  db_connect();
    $sql = "insert into client (client_email)";
    $sql .= "values('$email_address')";
    $result = pg_query($conn,$sql);
    

    insert_client($email_address);
    $_SESSION['message'] = "Register successful for a new client";
    }
    else{
        $error.="</br>Please try again!!!";
        $_SESSION['message'] = $error;  
      }
      
        
     }
      ?>
        <h2 id = "error"> <?php echo $error; ?></h2>
        <h2 id = "message"> <?php echo $message; ?></h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Add a new client</h1>
    <label for="input_email" class="sr-only">Client Email</label>
    <input type="email" id="inputEmail" name="input_email" class="form-control" placeholder="Client Email" required autofocus>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register Client</button>
    </form>
    </div>
</div>

<?php include './includes/footer.php'; ?>