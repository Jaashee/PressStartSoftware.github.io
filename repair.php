<?php include './includes/header.php'; ?> 

<div class="main-content">
    <div class="container">
        <h1><b>Console Repair page</b></h1>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Employee who assisted</label>
                <input aria-describedby="emailHelp" class="form-control" id="employeeassist" placeholder="Employee ID"
                       type="number">

            </div>
            <div class="form-group">
                <label for="clientemail">Client Email </label>
                <input class="form-control" id="clientemail" placeholder="Enter Email" type="email">
            </div>
            <div class="form-group">
                <label for="firstname">Client Firstname </label>
                <input class="form-control" id="firstname" placeholder="Enter Firstname" type="text">
            </div>
            <div class="form-group">
                <label for="lastname">Client Lastname </label>
                <input class="form-control" id="lastname" placeholder="Enter Lastname" type="text">
            </div>
            <div class="form-group">
                <label for="phonenumber">Client PhoneNumber</label>
                <input class="form-control" id="phonenumber" placeholder="Enter PhoneNumber" type="number">
            </div>
            <div class="form-group">
                <label for="repairdate">Repair Date</label>
                <input class="form-control" id="repairdate" placeholder="Enter Date" type="Text">
            </div>
            <button class="btn btn-primary" type="submit">Process Repair</button>
        </form>
    </div>
</div>

<?php include './includes/footer.php'; ?>