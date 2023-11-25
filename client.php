<!doctype html>
<html lang="en">
<head>
<?php 
require("./includes/constants.php");
require("./includes/db.php");

$email_address="";
$error="";
$message="";
?>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>PressStart - Dashboard</title>
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="./content/styles.css" rel="stylesheet"/>

</head>
<body>

<div class="sidebar">
    <div class="top">
        <div class="logo">
        </div>
        <i class="fa-solid fa-bars" id="btn"></i>
        <div class="pressstart">
            <img alt="name" class="pressstart" src="./content/pressstart.webp">
        </div>
        <ul>
            <li>
                <a href="index.html">
                    <i class="fa-brands fa-dashcube"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="inventory.html">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span class="nav-item">Inventory</span>
                </a>
                <span class="tooltip">Inventory</span>
            </li>
            <li>
                <a href="client.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="nav-item">Client</span>
                </a>
                <span class="tooltip">Client</span>
            </li>
            <li>
                <a href="buy.html">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="nav-item">Buy</span>
                </a>
                <span class="tooltip">Buy</span>
            </li>
            <li>
                <a href="sell.html">
                    <i class="fa-solid fa-money-bill"></i>
                    <span class="nav-item">Sell/Returns</span>
                </a>
                <span class="tooltip">Sell/Returns</span>
            </li>
            <li>
                <a href="repair.html">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span class="nav-item">Repairs</span>
                </a>
                <span class="tooltip">Repairs</span>
            </li>
            <li>
                <a href="login.html">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>
</div>

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

<!-- Scripting Section -->
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./scripts/app.js"></script>
</body>
</html>