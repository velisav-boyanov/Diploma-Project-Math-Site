<?php namespace View;

use Controller\TriangleSaveController;
use FigureContainers\FigureTriangle;

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/View/main.php">Main</a>
    <a href="../../Diploma-Project-Math-Site/View/triangle.php">Triangle</a>
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
        <label for="options">Personal or post:</label><select id="options" name="blog">
            <option value="1">Blog</option>
            <option value="0">Personal</option>
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
    <?php foreach ($userSaves as $i) {?>
        <div>
            <div class = "card-body">
                <h4 class = "card-title"><?php echo $i['Type'];?></h4>
                <p class = "card-text">
                    <?php
                    if ($i['SolvingText']) {
                        $given = array();
                        foreach (json_decode($i['Given']) as $f) {
                            array_push($given, TriangleSaveController::PARAMETERS[$f]);
                        }
                        $given = implode(",", $given);
                        echo $given;
                    } else {
                        echo $i['Given'];
                    }
                    ?>
                </p>
                <p class = "card-text"><?php
                if ($i['SolvingText'] != '') {
                    echo $i['SolvingText'];
                } else {
                    echo "Find:" . $i['Parameters'];
                }
                ?></p>
                <?php
                if ($i['SolvingText'] != '') {
                    $triangle = new FigureTriangle(json_decode($i['Parameters']));
                    $triangle->sendCookies();
                    setcookie("HowWasItSolved", json_decode($i['SolvingText']), time() + 3600);
                }
                ?>
                <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=remove" method="post">
                    <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Delete</button>
                </form>
                <?php if ($i['SolvingText'] != '') {?>
                <a href="../View/triangleResult.php" class = "btn-light">Show More</a>
                    <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=generateSimilar" method="post">
                        <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Generate similar exercise</button>
                    </form>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>

<h4>User test creation:</h4>
<div class="row">
    <?php foreach ($userSaves as $i) {?>
        <div>
            <div class = "card-body">
                <h4 class = "card-title"><?php echo $i['Type'];?></h4>
                <p class = "card-text">
                    <?php
                    if ($i['SolvingText']) {
                        $given = array();
                        foreach (json_decode($i['Given']) as $f) {
                            array_push($given, TriangleSaveController::PARAMETERS[$f]);
                        }
                        $given = implode(",", $given);
                        echo $given;
                    } else {
                        echo $i['Given'];
                    }

                    ?>
                </p>
                <p class = "card-text"><?php
                if ($i['SolvingText'] != '') {
                    echo $i['SolvingText'];
                } else {
                    echo "Find:" . $i['Parameters'];
                }
                ?></p>
                <?php if ($i['Test_Added'] == 1) {?>
                    <h6>Exercises was added.</h6>
                    <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=markAsUnAdded" method="post">
                        <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Remove exercise</button>
                    </form>
                <?php } else {?>
                    <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=addToSaveArray" method="post">
                        <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Add exercise</button>
                    </form>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>

<style>
    <?php include 'Styles/navbar.css';
    ?>
</style>

<form action="../../Diploma-Project-Math-Site/index.php?target=test&action=add" method="post">
    <button type="submit">Finalize test</button>
</form>

<script type="text/javascript">
    getSaveId = function (id){
        document.cookie = "PostId=" + String(id);
        $("#form").submit();
    }
</script>

</body>
</html>

