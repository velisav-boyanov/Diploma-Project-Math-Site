<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/View/main.php">Main Page</a>
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

<h3>Fill in the blank spots and press run.</h3>

<form name = "triangle" action="../../Diploma-Project-Math-Site/index.php?target=triangle&action=fillTriangle" method="post">
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
                                                                                <label>Perimeter:</label>
                                                                                <input type="number" name = "P" class="form-control" >
                                                                                <div class="form-group">
                                                                                    <br>
                                                                                    <label>Side(CL) cut by bisector AL:</label>
                                                                                    <input type="number" name = "ClFromA" class="form-control" >
                                                                                    <div class="form-group">
                                                                                        <label>Side(BL) cut by bisector AL:</label>
                                                                                        <input type="number" name = "BLFromA" class="form-control" >
                                                                                        <div class="form-group">
                                                                                            <label>Side(CL) cut by bisector BL:</label>
                                                                                            <input type="number" name = "CLFromB" class="form-control" >
                                                                                            <div class="form-group">
                                                                                                <label>Side(AL) cut by bisector BL:</label>
                                                                                                <input type="number" name = "ALFromB" class="form-control" >
                                                                                                <div class="form-group">
                                                                                                    <label>Side(AL) cut by bisector CL:</label>
                                                                                                    <input type="number" name = "ALFromC" class="form-control" >
                                                                                                    <div class="form-group">
                                                                                                        <label>Side(BL) cut by bisector CL:</label>
                                                                                                        <input type="number" name = "BLFromC" class="form-control" >
                                                                                                        <div class="form-group">
                                                                                                            <br>
                    <button type="submit" class="btn btn-primary"> run </button>
                </div>
</form>

<style>
    <?php include 'Styles/navbar.css' ?>
    <?php include '../Styles/navbar.css' ?>
</style>

</body>
</html>
