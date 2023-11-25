<!DOCTYPE html>
<html lang="en">
<head>
    <?php
require("./includes/constants.php");
require("./includes/db.php");
$message = "";
?>
    <meta charset="UTF-8">
    <title>Employee Login page</title>
    <style>
        h1 {
            text-align: center;
        }

        b {
            text-align: center;
        }

        form {
            text-align: center;
        }
    </style>
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="./content/styles.css" rel="stylesheet"/>
</head>
<body>

<div class="sidebar">
    <div class="top">
        <div class="logo">
            <i class="fa-solid fa-gamepad"></i>
            <span>Press Start</span>
        </div>
        <i class="fa-solid fa-bars" id="btn"></i>
        <div class="pressstart">
            <img alt="name" class="pressstart" src="./content/pressstart.webp">
            <div>
                <p class="bold"> PressStart</p>
            </div>
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

<!-- Scripting Section -->
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./scripts/app.js"></script>
<script src="./databasepg.js"></script>
</body>
</html>