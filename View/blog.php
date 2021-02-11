<?php namespace View;
use Controller\CommentController;
use Controller\TriangleSaveController;
use Controller\UserController;
use FigureContainers\FigureTriangle;
?>

<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/index.php?target=comment&action=renderBlogs">Discussion</a>
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

<?php
$user = new TriangleSaveController();
$userSaves = $user->getBlogs();
$id = array_search($_COOKIE['PostId'], array_column($userSaves, 'Id'));
?>

<div class = "post">
    <div class = "card-body">
        <h4 class = "card-title"><?php echo $userSaves[$id]['Type'];?></h4>
        <p class = "card-text"><?php echo $userSaves[$id]['Given']?></p>
        <?php
        $userId = $userSaves[$id]['User_Id'];
        $userController = new UserController();
        $user = $userController->getById($userId);
        ?>
        <p class = "card-text">User: <?php echo $user['user']['Username']?></p>
    </div>
</div>
<br>
<h3>Comment section:</h3>
<br>
<form action="../../Diploma-Project-Math-Site/index.php?target=comment&action=add" method="post">
    <div class="form-group">
        <label>Comment:</label>
        <input type="text" name = "Message" class="form-control" required>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> submit </button>
                </div>
</form>
<?php
$comment = new CommentController();
$postSaves = $comment->getByPostId($_COOKIE['PostId']);
?>
<div class="row">
    <?php
    if(!array_key_exists("msg", $postSaves)){
        foreach($postSaves as $i) {?>
            <div>
                <div class = "card-body">
                    <h4 class = "card-text">User: <?php echo $i['Username']; ?></h4>
                    <p class = "card-title"><?php echo $i['Created_At'];?></p>
                    <p class = "card-text"><?php echo $i['Message']?></p>
                    <?php $userId = $_SESSION['UserId']; if($userId == $i['User_Id']){?>
                    <form action="../../Diploma-Project-Math-Site/index.php?target=comment&action=removeComment" method="post">
                        <button type="submit" onclick="getCommentId(<?php echo $i['Id'] ?>)">Delete Comment</button>
                    </form>
                    <?php }?>
                </div>
            </div>
    <?php }}else{?> <h5>No comments.</h5> <?php } ?>
</div>
<script type="text/javascript">
    getCommentId = function (id){
        document.cookie = "CommentId=" + String(id);
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

