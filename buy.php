<?php include './includes/header.php'; ?> 

<div class="main-content">
    <div class="container">
        <h1>Buy Page</h1>
    </div>

<form>
    <div class="form-group">
        <label for="gametitle">Game Title:</label>
        <input class="form-control" id="gametitle" placeholder="Enter Title" type="text">

    </div>


    <div class="form-group">
        <label for="platform">Platform:</label>
        <input class="form-control" id="platform" placeholder="Enter Platform" type="text">
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input class="form-control" id="price" placeholder="Enter Price" type="text">
    </div>

    <div class="form-group">
        <input id="perfect" name="ConditionSelect" type="radio" value="Perfect">
        <label for="perfect">Perfect Condition</label><br>
        <input id="good" name="ConditionSelect" type="radio" value="Good">
        <label for="css">Good Condition</label><br>
        <input id="javascript" name="ConditionSelect" type="radio" value="JavaScript">
        <label for="javascript">Okay Condition</label>
    </div>

    <button class="btn btn-primary" type="submit">Process</button>
</form>

<button class='btn btn-primary' id='market' style='float: right ;'>Online Market</button>
</div>

<?php include './includes/footer.php'; ?>