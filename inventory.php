<?php include './includes/header.php'; 


if(! isset($_SESSION['employee_id'])) 
{
	Header("Location: login.php");
}  ?> 
<div class="main-content">
    <div class="container">
        <h1>Inventory Page</h1>
        <div>
            <h2 href="gameinventory.php">Game Inventory</h2>
            <h2 href="consoleinvenory.php">Console Inventory</h2>
            <h2 href="accessoryinventory.php">Accessories Inventory</h2>
        
        </div>
        
        
        

    </div>
</div>

<?php include './includes/footer.php';
   

