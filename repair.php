<?php include './includes/header.php'; ?> 
<?php

if(! isset($_SESSION['employee_id'])) 
{
	Header("Location: login.php");
}

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $employee_id = 0;
        $email_address = "";
        $console = "";
        $price = "";
        $prodid = 0;
        $message = "";
        
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $employee_id = trim($_POST['employee_id']);
        $email_address = trim($_POST['email_address']);
        $console = trim($_POST['console']);
        $price = trim($_POST['price']);
        $prodid = trim($_POST['productid']);
     
        
        
        
        //error checking
        $valid = true;
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $message = "Client email not formatted correctly";
        }
      
        if(!isset($price)||trim($price)==""){
            $message ="The price of repair is required";
            $price = "";
            $valid = false;
        }
        if(!isset($console)||trim($console)==""){
            $message ="The name of console is required";
            $console = "";
            $valid = false;
        }
        if(!is_numeric($prodid)){
            $message = "Product ID must be a number";
            $prodid = "";
            $valid = false;
            
            }
            else{
                $query2 = pg_query($conn,"SELECT * FROM  product WHERE product_id= '$prodid'");
                if(pg_num_rows($query2)>0)
                {
                  
                    $message = "Product ID entered already exists";
                    $valid = false;
                }
            }
        if(!is_numeric($employee_id)){
                $message = "Employee ID is required";
                $valid = false;
                
            }
       else{
        $query = pg_query($conn,"SELECT * FROM  employee WHERE employee_id= '$employee_id'");
        if(!(pg_num_rows($query)>0))
        {
           
            $message = "Employee ID does not exist";
            $valid = false;
        }
       }
        
    
        $date = date("Y-m-d");
        
        $sql = "INSERT INTO repair (employee_id,console,repair_date,repair_status,client_email)";
        $sql .= "VALUES ('$employee_id','$console','$date','ongoing','$email_address')";
        $sql2 = "INSERT INTO transactions (price,repair_date,transaction_type)";
        $sql2 .= "VALUES ('$price','$date','+')"; 
        $sql3 = "INSERT INTO product (product_id,price,name_of_product,product_type)";
        $sql3 .= "VALUES ('$prodid','$price','$console','console')";
        $sql4 = "INSERT INTO invoice_item (product_id,item_qty,order_date)";
        $sql4 .= "VALUES ('$prodid','1','$date')";
     
    
        if ($valid) {
            if (pg_query($conn, $sql)) {
                if (pg_query($conn, $sql2)) {
                    if (pg_query($conn, $sql3)) {
                        if (pg_query($conn, $sql4)) {
                            $message = "The repair was successfully saved!";
                        }
                    }
                }
                
                
            } 
        }
    
    }
    ?>
    <div class="main-content">
        <div class="container">
            <div width="400">
            <h1><b>Console Repair Page</b></h1>
            <h2 id = "errors"> <?php echo $message; ?></h2>
  <div>
  <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="form-group">
        <label for="employee_id">Employee ID:</label>
        <input class="form-control" value="<?php $employee_id ?>" name="employee_id" id="gametitle" placeholder="Enter Employee who assisted"  type="number">
    </div>


    <div class="form-group">
        <label for="email_address">Client Email:</label>
        <input class="form-control" value="<?php $email_address ?>" name="email_address" placeholder="Enter client email" type="email">
    </div>
    
    <div class="form-group">
        <label for="console">Console:</label>
        <input class="form-control" value="<?php $console ?>" name="console" placeholder="Enter console name" type="text">
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input class="form-control" value="<?php $employee_id ?>" name="price" placeholder="Enter price of repair" type="text">
    </div>
    <div class="form-group">
        <label for="productid">Product ID:</label>
        <input class="form-control" value="<?php $prodid ?>" name="productid" placeholder="Enter sequence of numbers" type="number">
    </div>

   

    <button class="btn btn-primary" type="submit">Save Repair</button>
</form>
 </div>
 <div></div>
    
    <?php
    $ongoingqeury = "select * from repair WHERE repair_status= 'ongoing'";
    $ongoingresult = pg_query($conn,$ongoingqeury);
    ?>
   
      
                    
    
    
       <div> <table class="table table-bordered text-center">
        <tr>
            <td>Repair ID</td>
            <td>Employee ID</td>
            <td>Console Name</td>
            <td>Repair Start Date</td>
            <td>Repair Status</td>
            <td>Client Email</td>
        </tr>
        <tr>
       <?php
    
        while($row = pg_fetch_assoc($ongoingresult))
        {
        ?>
        <td><?php echo $row['repair_id']?></td>
        <td><?php echo $row['employee_id']?></td>
        <td><?php echo $row['console']?></td>
        <td><?php echo $row['repair_date']?></td>
        <td><?php echo $row['repair_status']?></td>
        <td><?php echo $row['client_email']?></td>
        </tr>
        <?php
        } 
       ?>
        
    </table></div>
        
    <div>  <a href="repairstatus.php">
                        <span class="nav-item">Change Repair Status</span>
                        <i class="fa-solid fa-arrow-right"></i>
                       
                    </a></div>
    
    </div>
    <style>
        table,tr,th,td
        {
            border: 1px solid black;
        }
    </style>
    <?php
    if(isset($_POST['search']))
    {
        $valueToSearch = $_POST['valueToSearch'];
        $query = "SELECT * FROM `repairs` where concat(`repair_id`, `employee_id`, `console`, `repair_date`, `repair_status`, `client_email`) LIKE '%".$valueToSearch."%'";
        $search_result = filterTable($query);
    }
    else {
        $query = "SELECT * FROM `repairs`";
        $search_result = filterTable($query);
    }

    function filterTable($query)
    {
        $connect = mysqli_connect("localhost", "root", "", "PressStart_db");
        $filter_Result = mysqli_query($connect, $query);
        return $filter_Result;
    }
    ?>
        <form action="repair.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value to Search"><br><br>
            <input type="submit" name="search" value="filter"><br><br>
            <table>
                <tr>
                    <th>Repair ID</th>
                    <th>Employee ID</th>
                    <th>Console</th>
                    <th>Repair Date</th>
                    <th>Repair Status</th>
                    <th>Client Email</th>
                </tr>
                <?php while($row = mysqli_fetch_array($search_result)):?>
                    <tr>
                        <td><?php echo $row['repair_id'];?></td>
                        <td><?php echo $row['employee_id'];?></td>
                        <td><?php echo $row['console'];?></td>
                        <td><?php echo $row['repair_date'];?></td>
                        <td><?php echo $row['repair_status'];?></td>
                        <td><?php echo $row['client_email'];?></td>
                    </tr>
                <?php endwhile;?>
            </table>
        </form>

    <?php include './includes/footer.php'; 
 

?>