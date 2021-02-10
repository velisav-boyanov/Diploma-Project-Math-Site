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

<h3>Here you can discuss other users posts:</h3>
<?php
$saveController = new TriangleSaveController();
$userSaves = $saveController->getBlogs();
?>
<div class="row">
    <?php
    foreach($userSaves as $i) {?>
        <div>
            <div class = "card-body">
                <h4 class = "card-title"><?php echo $i['Type'];?></h4>
                <p class = "card-text"><?php echo $i['Given']?></p>
                <?php
                $triangle = new FigureTriangle(json_decode($i['Parameters']));
                $triangle->sendCookies();
                setcookie("HowWasItSolved", json_decode($i['SolvingText']),time()+3600);
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

