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
        $email_address =trim($_POST['inputEmail']);
     

     if(!isset($email_address)|| $email_address ="")
    {
    $error.="You must enter email address</br>";
    } 
    elseif(!filter_var($email_address,FILTER_VALIDATE_EMAIL)){
    $error.=$email_address."is not valid</br>";
    $email_address="";   
    }
    elseif(user_exists($email_address)){
    $error.= "This email(".$email_address.") already exists</br>";
        
    }
    if($error=="")
    {

    insert_user($email_address);
    $_SESSION['message'] = "Register successful for a new client";
    }
    else{
        $error.="</br>Please try again!!!";
        $_SESSION['message'] = $error;  
      }
      
        
     }


     $form_client = array(
        array(
        "type"=>"text",
        "name"=>"inputFName",
        "value"=>"",
        "label"=>"First Name"

        )
    );

    display_form($form_client);
      ?>
        
    </div>
</div>

<?php include './includes/footer.php'; ?>