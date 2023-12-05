<?php include './includes/header.php'; 


if(! isset($_SESSION['employee_id'])) 
{
	Header("Location: login.php");
}  ?> 
<div class="main-content">
    <div class="container">
        <h1>Inventory Page</h1>
        <div>
            <h2>Game Inventory</h2>
        <table class="table table-bordered text-center"><tr><td>game_id</td><td>title</td><td>price</td><td>condition</td><td>platform</td><td>is_sold</td></tr></table>
        <h2>Console Inventory</h2>
        <table class="table table-bordered text-center"><tr><td>console_id</td><td>name</td><td>price</td><td>platform</td><td>is_sold</td></tr></table>
        <h2>Accessories Inventory</h2>
        <table class="table table-bordered text-center"><tr><td>accessories_id</td><td>name</td><td>price</td><td>is_sold</td></tr></table>
        
        </div>
        
        
        

    </div>
</div>

<?php include './includes/footer.php';
   

