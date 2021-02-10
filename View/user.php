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

<h5>Custom save:</h5>
<form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=addCustom" method="post">
    <div class="form-group">
        <label for="options">Choose a type:</label><select id="options" name="options">
            <option value="Triangle">Triangle</option>
            <option value="Rectangle">Rectangle</option>
            <option value="Circle">Circle</option>
        </select>
        <div class="form-group">
            <label>Given</label>
            <input type="text" name = "Given" class="form-control" required>
            <div class="form-group">
                <label>Find</label>
                <input type="text" name = "Find" class="form-control" required>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
</form>


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
                <p class = "card-text"><?php
                    if($i['SolvingText'] != '') {
                        echo $i['SolvingText'];
                    }else{
                        echo "Find:" . $i['Parameters'];
                    }
                    ?></p>
                <?php
                if($i['SolvingText'] != '') {
                    $triangle = new FigureTriangle(json_decode($i['Parameters']));
                    $triangle->sendCookies();
                    setcookie("HowWasItSolved", json_decode($i['SolvingText']), time() + 3600);
                }
                ?>
                <?php if($i['SolvingText'] != ''){?>
                <a href="../View/triangleResult.php" class = "btn-light">Show More</a>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>

<style>
    <?php include 'Styles/navbar.css' ?>
</style>

</body>
</html>

