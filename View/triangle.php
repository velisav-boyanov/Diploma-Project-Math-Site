<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="#rectangle">Rectangle</a>
    <a href="#circle">Circle</a>
    <div class="dropdown">
        <button class="dropbtn">Authentication
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="View/login.php">Login</a>
            <a href="View/register.php">Register</a>
        </div>
    </div>
</div>

<h3>Fill in the blank spots and press run.</h3>

<form name = "triangle" action="../index.php?target=triangle&action=run" method="post">
    <div class="form-group">
        <label>Side AB:</label>
        <input type="number" name = "AB" class="form-control" >
        <div class="form-group">
            <label>Side AC:</label>
            <input type="number" name = "AC" class="form-control" >
            <div class="form-group">
                <label>Side BC:</label>
                <input type="number" name = "BC" class="form-control" >
                <div class="form-group">
                    <br>
                    <label>Angle A:</label>
                    <input type="number" name = "A" class="form-control" >
                    <div class="form-group">
                        <label>Angle B:</label>
                        <input type="number" name = "B" class="form-control" >
                        <div class="form-group">
                            <label>Angle C:</label>
                            <input type="number" name = "C" class="form-control" >
                            <div class="form-group">
                                <br>
                                <label>Median AM:</label>
                                <input type="number" name = "AM" class="form-control" >
                                <div class="form-group">
                                    <label>Median BM:</label>
                                    <input type="number" name = "BM" class="form-control" >
                                    <div class="form-group">
                                        <label>Median CM:</label>
                                        <input type="number" name = "CM" class="form-control" >
                                        <div class="form-group">
                                            <br>
                                            <label>Bisector AL:</label>
                                            <input type="number" name = "AL" class="form-control" >
                                            <div class="form-group">
                                                <label>Bisector BL:</label>
                                                <input type="number" name = "BL" class="form-control" >
                                                <div class="form-group">
                                                    <label>Bisector CL:</label>
                                                    <input type="number" name = "CL" class="form-control" >
                                                    <div class="form-group">
                                                        <br>
                                                        <label>Height AH:</label>
                                                        <input type="number" name = "AH" class="form-control" >
                                                        <div class="form-group">
                                                            <label>Height BH:</label>
                                                            <input type="number" name = "BH" class="form-control" >
                                                            <div class="form-group">
                                                                <label>Height CH:</label>
                                                                <input type="number" name = "CH" class="form-control" >
                                                                <div class="form-group">
                                                                    <br>
                                                                    <label>Radius of Outer Circle:</label>
                                                                    <input type="number" name = "RLarge" class="form-control" >
                                                                    <div class="form-group">
                                                                        <label>Radius of inner Circle:</label>
                                                                        <input type="number" name = "RSmall" class="form-control" >
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <label>Surface:</label>
                                                                            <input type="number" name = "S" class="form-control" >
                                                                            <div class="form-group">
                                                                                <label>Parameter:</label>
                                                                                <input type="number" name = "P" class="form-control" >
                                                                                <div class="form-group">
                                                                                    <br>
                    <button type="submit" class="btn btn-primary"> run </button>
                </div>
</form>

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
