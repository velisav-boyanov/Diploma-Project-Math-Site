<?php namespace View;

use Controller\TriangleSaveController;
use Controller\UserController;
use FigureContainers\FigureTriangle;

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

<h3>Here you can discuss other users posts:</h3>
<?php
$saveController = new TriangleSaveController();
$userSaves = $saveController->getBlogs();
?>
<div class="row">
    <?php
    foreach ($userSaves as $i) {?>
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

                <?php
                if ($i['SolvingText'] != '') {
                    $triangle = new FigureTriangle(json_decode($i['Parameters']));
                    $triangle->sendCookies();
                    setcookie("HowWasItSolved", json_decode($i['SolvingText']), time() + 3600);
                }
                $userId = $i['User_Id'];
                $user = new UserController();
                $userName = $user->getById($userId);
                ?>
                <p class = "card-text">User: <?php echo $userName['user']['Username']?></p>
                <form action="../../Diploma-Project-Math-Site/index.php?target=comment&action=renderBlog" method="post">
                    <button type="submit" onclick="beforeSubmit(<?php echo $i['Id']?>)">View Comments</button>
                </form>
            </div>
        </div>
    <?php }?>
</div>

<script type="text/javascript">
    beforeSubmit = function (id){
        document.cookie = "PostId=" + String(id);
        $("#form").submit();
    }
</script>

<style>
    <?php include 'Styles/navbar.css';
    ?>
</style>

</body>
</html>

