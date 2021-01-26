<?php namespace View;
use Controller\TriangleSaveController;?>

<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="View/main.php">Main</a>
    <a href="View/triangle.php">Triangle</a>
    <a href="#rectangle">Rectangle</a>
    <a href="#circle">Circle</a>
    <div class="dropdown">
        <button class="dropbtn">Authentication
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>
</div>

<h3>User library:</h3>
<?php
$user = new TriangleSaveController();
$userSaves = $user->getByUserId($_SESSION["UserId"]);
?>
<div class="row">
    <?php foreach($userSaves as $i) {?>
        <div>
            <div class = "card-body">
                <h4 class = "card-title"><?php echo $i['Type'];?></h4>
                <p class = "card-text"><?php echo $i['Given']?></p>
                <p class = "card-text"><?php echo $i['SolvingText']?></p>
                <a href="" class = "btn-light">Show More<span class = "text-danger">&rarr;</span></a>
            </div>
        </div>
    <?php }?>
</div>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .navbar {
        overflow: hidden;
        background-color: #333;
    }

    .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropdown {
        float: left;
        overflow: hidden;
    }

    .dropdown .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: red;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;

</style>

</body>
</html>

