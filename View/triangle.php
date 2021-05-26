<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/View/main.php">Main Page</a
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
        <input type="number" min="0" step="any" name = "AB" class="form-control" >
        <div class="form-group">
            <label>Side AC:</label>
            <input type="number" min="0" step="any" name = "BC" class="form-control" >
            <div class="form-group">
                <label>Side BC:</label>
                <input type="number" min="0" step="any" name = "AC" class="form-control" >
                <div class="form-group">
                    <br>
                    <label>Angle A:</label>
                    <input type="number" min="0" step="any" name = "A" class="form-control" >
                    <div class="form-group">
                        <label>Angle B:</label>
                        <input type="number" min="0" step="any" name = "B" class="form-control" >
                        <div class="form-group">
                            <label>Angle C:</label>
                            <input type="number" min="0" step="any" name = "C" class="form-control" >
                            <div class="form-group">
                                <br>
                                <label>Median AM:</label>
                                <input type="number" min="0" step="any" name = "AM" class="form-control" >
                                <div class="form-group">
                                    <label>Median BM:</label>
                                    <input type="number" min="0" step="any" name = "BM" class="form-control" >
                                    <div class="form-group">
                                        <label>Median CM:</label>
                                        <input type="number" min="0" step="any" name = "CM" class="form-control" >
                                        <div class="form-group">
                                            <br>
                                            <label>Bisector AL:</label>
                                            <input type="number" min="0" step="any" name = "AL" class="form-control" >
                                            <div class="form-group">
                                                <label>Bisector BL:</label>
                                                <input type="number" min="0" step="any" name = "BL" class="form-control" >
                                                <div class="form-group">
                                                    <label>Bisector CL:</label>
                                                    <input type="number" min="0" step="any" name = "CL" class="form-control" >
                                                    <div class="form-group">
                                                        <br>
                                                        <label>Height AH:</label>
                                                        <input type="number" min="0" step="any" name = "AH" class="form-control" >
                                                        <div class="form-group">
                                                            <label>Height BH:</label>
                                                            <input type="number" min="0" step="any" name = "BH" class="form-control" >
                                                            <div class="form-group">
                                                                <label>Height CH:</label>
                                                                <input type="number" min="0" step="any" name = "CH" class="form-control" >
                                                                <div class="form-group">
                                                                    <br>
                                                                    <label>Radius of Outer Circle:</label>
                                                                    <input type="number" min="0" step="any" name = "RLarge" class="form-control" >
                                                                    <div class="form-group">
                                                                        <label>Radius of inner Circle:</label>
                                                                        <input type="number" min="0" step="any" name = "RSmall" class="form-control" >
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <label>Surface:</label>
                                                                            <input type="number" min="0" step="any" name = "S" class="form-control" >
                                                                            <div class="form-group">
                                                                                <label>Perimeter:</label>
                                                                                <input type="number" min="0" step="any" name = "P" class="form-control" >
                                                                                <div class="form-group">
                                                                                    <br>
                                                                                    <label>Side(CL) cut by bisector AL:</label>
                                                                                    <input type="number" min="0" step="any" name = "ClFromA" class="form-control" >
                                                                                    <div class="form-group">
                                                                                        <label>Side(BL) cut by bisector AL:</label>
                                                                                        <input type="number" min="0" step="any" name = "BLFromA" class="form-control" >
                                                                                        <div class="form-group">
                                                                                            <label>Side(CL) cut by bisector BL:</label>
                                                                                            <input type="number" min="0" step="any" name = "CLFromB" class="form-control" >
                                                                                            <div class="form-group">
                                                                                                <label>Side(AL) cut by bisector BL:</label>
                                                                                                <input type="number" min="0" step="any" name = "ALFromB" class="form-control" >
                                                                                                <div class="form-group">
                                                                                                    <label>Side(AL) cut by bisector CL:</label>
                                                                                                    <input type="number" min="0" step="any" name = "ALFromC" class="form-control" >
                                                                                                    <div class="form-group">
                                                                                                        <label>Side(BL) cut by bisector CL:</label>
                                                                                                        <input type="number"  min="0" step="any" name = "BLFromC" class="form-control" >
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
