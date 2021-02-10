<?php namespace View;
use Controller\TriangleSaveController;
use FigureContainers\FigureTriangle;

?>

<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/View/main.php">Main</a>
    <a href="../../Diploma-Project-Math-Site/View/triangle.php">Triangle</a>
    <a href="#rectangle">Rectangle</a>
    <a href="#circle">Circle</a>
    <div class="dropdown">
        <button class="dropbtn">Authentication
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="../../Diploma-Project-Math-Site/View/login.php">Login</a>
            <a href="../../Diploma-Project-Math-Site/View/register.php">Register</a>
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
                <p class = "card-text">Given:<?php echo $i['Given']?></p>
                <p class = "card-text"><?php echo $i['SolvingText']?></p>
                <?php
                $triangle = new FigureTriangle(json_decode($i['Parameters']));
                $triangle->sendCookies();
                setcookie("HowWasItSolved", json_decode($i['SolvingText']),time()+3600);
                ?>
                <a href="../View/triangleResult.php" class = "btn-light">Show More</a>
            </div>
        </div>
    <?php }?>
</div>

<style>
    <?php include 'Styles/navbar.css' ?>
</style>

</body>
</html>

