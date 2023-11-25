<?php include './includes/header.php'; ?> 

<div class="main-content">
    <div class="container">
        <h1>Sell/Returns Page</h1>
    </div>
    <div class="form-styled">
    <form>
        <div class="form-group">
            <label for="gametitle">Game ID:</label>
            <input type="text" class="form-control" id="gametitle" placeholder="Enter Title">

        </div>


        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" placeholder="Enter Price">
        </div>
        <!--If its sell then the transaction type is deposit, and withdrawl for return -->
        <div class="form-group">
            <input type="radio" id="sell" name="TransactionSelect" value="Sell">
            <label for="perfect">Sell</label><br>
            <input type="radio" id="return" name="TransactionSelect" value="Return">
            <label for="css">Return</label><br>

        </div>

        <div class="form-group button-group"> <!-- Add this div to group the buttons -->
            <button type="submit" class="btn btn-primary">Process</button>
            <button id='market' class='btn btn-primary' style='margin-left: 10px;'>Online Market</button>
        </div>
    </form>
</div>
</div>

<?php include './includes/footer.php'; ?>