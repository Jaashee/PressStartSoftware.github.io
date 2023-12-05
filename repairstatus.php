<?php include './includes/header.php'; ?> 
<?php
if(! isset($_SESSION['employee_id'])) 
{
    header("Location: login.php");
}
 if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $repair_status = "";
        $repair_id = 0;
        $message = "";
        
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $repair_id = trim($_POST['repair_id']);
        $repair_status = trim($_POST['repair_status']);
        
        $message = "";
    
       
        $numlength = strlen((string)$repair_id);
    
        //error checking
        $valid = true;
    
     
       
         if(!is_numeric($repair_id)){
            $message = "Repair ID is required";
            $valid = false;
            
        }
        else{
            $query = pg_query($conn,"SELECT * FROM  repair WHERE repair_id= '$repair_id'");
            if(!(pg_num_rows($query)>0)){
                
                $message = "Repair ID does not exist";
                $valid = false;
            
                }
        }
        
          if(!($repair_status == "complete"|| $repair_status == "ongoing")){
            $message ="Repair Status can only be 'complete' or 'ongoing'";
            $repair_status = "";
            $valid = false;
        }
        
       
        
    
    
        
        $sql = "UPDATE repair ";
        $sql .= "SET repair_status = ('$repair_status')";
        $sql .= "WHERE repair_id = $repair_id";
    
     
    
        if ($valid) {
            if (pg_query($conn, $sql)) {
             
                $message = "Repair status successfully changed!";
                
            } 
        }
    
    }
    ?>
    <div class="main-content">
        <div class="container">
            <div>
            <h1><b>Repair Status Page</b></h1>
            <a href="repair.php">
            <i class="fa-solid fa-arrow-left"></i>
                        <span class="nav-item">Back to Repair Page</span>
                        
                       
                    </a>
            </div>
            
            <h2 id = "errors"> <?php echo $message; ?></h2>
 
    <div>

    <form  method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
 <div class="form-group">
	 <label for="gametitle">Repair ID:</label>
	 <input class="form-control" name="repair_id" value="<?php $repair_id ?>"  placeholder="Enter repair ID" type="number">

 </div>
 <div class="form-group">
	 <label for="gametitle">Repair Status:</label>
	 <input class="form-control" name="repair_status" value="<?php $repair_status ?>"  placeholder="Enter repair status" type="text">

 </div>
 

 <button class="btn btn-primary" type="submit">Save</button>
</form>
   
    </div>
            
      
    
    <?php include './includes/footer.php'; 


?>