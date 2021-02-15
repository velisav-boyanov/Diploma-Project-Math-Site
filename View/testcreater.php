<?php
namespace View;
use Controller\TriangleSaveController;
use Controller\TriangleController;
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
                <p class = "card-text"><?php
                    if($i['SolvingText'] != '') {
                        echo $i['SolvingText'];
                    }else{
                        echo "Find:" . $i['Parameters'];
                    }
                    ?></p>
                <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=addToSaveArray" method="post">
                    <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Add exercise</button>
                </form>
                <?php if($i['Test_Added'] == 1){?>
                    <h6>Exercises was added.</h6>
                    <form action="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=markAsUnAdded" method="post">
                        <button type="submit" onclick="getSaveId(<?php echo $i['Id']?>)">Remove exercise</button>
                    </form>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>

<form action="../../Diploma-Project-Math-Site/index.php?target=test&action=add" method="post">
    <button type="submit">Finalize test</button>
</form>

<style>
    <?php include 'Styles/navbar.css' ?>
    <?php include '../Styles/navbar.css' ?>
</style>

<script type="text/javascript">
    getSaveId = function (id){
        document.cookie = "PostId=" + String(id);
        $("#form").submit();
    }
</script>

</body>
</html>
