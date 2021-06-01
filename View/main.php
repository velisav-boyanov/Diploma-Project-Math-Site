<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/index.php?target=comment&action=renderBlogs">Discussion</a>
    <a href="../../Diploma-Project-Math-Site/index.php?target=triangleSave&action=renderSaves">User</a>
    <a href="../../Diploma-Project-Math-Site/View/triangle.php">Triangle</a>
    <div class="dropdown">
        <button class="dropbtn">Authentication
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="../../Diploma-Project-Math-Site/View/login.php">Login</a>
            <a href="../../Diploma-Project-Math-Site/View/register.php">Register</a>
            <?php if (isset($_SESSION["UserId"])) {
                ?>
                <a href="../../Diploma-Project-Math-Site/index.php?target=user&action=logout">Logout</a>
                <?php
            } ?>
        </div>
    </div>
</div>

<h3>Info about the site.</h3>
<a href="https://github.com/velisav-boyanov/Diploma-Project-Math-Site">GitHub</a>
<p>Used formulas:</p>

<style>
    <?php include '../Styles/navbar.css' ?>
    <?php include 'Styles/navbar.css' ?>
</style>

</body>
</html>