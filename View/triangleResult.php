<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="../../Diploma-Project-Math-Site/View/main.php">Main Page</a>
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

<h3>Calculated values.</h3>
<form action="http://localhost/Diploma-Project-Math-Site/View/triangle.php">
    <input type = "submit" value="Go back to input screen."/>
</form>
<script src = "JavaScript/three.js"></script>
<script>
    //scene set up
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);

    const renderer = new THREE.WebGL1Renderer({
        antialias: true
    });

    renderer.setSize((window.innerWidth/4), (window.innerHeight/4));

    document.body.appendChild(renderer.domElement);

    //triangle
    const geom = new THREE.Geometry();

    let ak = <?php  echo json_encode($_COOKIE['Ak']) ?>;
    let bk = <?php  echo json_encode($_COOKIE['Bk']) ?>;
    let ck = <?php  echo json_encode($_COOKIE['Ck']) ?>;
    let hk = <?php  echo json_encode($_COOKIE['Hk']) ?>;
    let right = <?php echo json_encode($_COOKIE['Right'])?>;
    let alk = Math.sqrt(Math.pow(bk, 2) - Math.pow(hk, 2));
    let c1;
    ak = parseInt(ak, 10);
    bk = parseInt(bk, 10);
    ck = parseInt(ck, 10);
    right = parseInt(right, 10);

    if((ak>bk) && (ak>ck) && (right===0)){
        c1 = -alk;
    }else {
        c1 = alk-(ck/2);
    }

    geom.vertices.push(new THREE.Vector3(-(ck/2), -3, 0));//base point(A) dose not change
    geom.vertices.push(new THREE.Vector3(ck/2, -3, 0));//base point B, dont change this point
    geom.vertices.push(new THREE.Vector3(c1, hk-3, 0));//point C

    geom.faces.push(new THREE.Face3(0, 1, 2));
    const material = new THREE.MeshBasicMaterial({
        color: 0xffffff
    });
    const mesh = new THREE.Mesh(geom, material);


    scene.add(mesh);

    camera.position.z = 5;

    //animates the image every frame
    function animate() {
        requestAnimationFrame(animate);

        renderer.render(scene, camera);
    }

    animate();
</script>

<p><?php echo $_COOKIE['HowWasItSolved']?></p>

<script type="text/javascript">
    function disableButton(btn){
        document.getElementById(btn.id).disabled = true;
    }
</script>

<form action="../index.php?target=triangleSave&action=add&argument=0" method="post">
    <input type = "submit" value="Add to user library." id="bt2" onclick="disableButton(this)"/>
</form>

<form action="../index.php?target=triangleSave&action=add&argument=1" method="post">
    <input type = "submit" value="Add to blog." id="bt3" onclick="disableButton(this)" />
</form>

<ul>
    <li>Side AB: <?php echo $_COOKIE['AB'];?></li>
    <li>Side AC: <?php echo $_COOKIE['AC'];?></li>
    <li>Side BC: <?php echo $_COOKIE['BC'];?></li>
</ul>
<ul>
    <li>Angle A Cosine: <?php echo $_COOKIE['A'];?></li>
    <li>Angle B Cosine: <?php echo $_COOKIE['B'];?></li>
    <li>Angle C Cosine: <?php echo $_COOKIE['C'];?></li>
</ul>
<ul>
    <li>Median AM: <?php echo $_COOKIE['AM'];?></li>
    <li>Median BM: <?php echo $_COOKIE['BM'];?></li>
    <li>Median CM: <?php echo $_COOKIE['CM'];?></li>
</ul>
<ul>
    <li>Bisector AL: <?php echo $_COOKIE['AL'];?></li>
    <li>Bisector BL: <?php echo $_COOKIE['BL'];?></li>
    <li>Bisector CL: <?php echo $_COOKIE['CL'];?></li>
</ul>
<ul>
    <li>Height AH: <?php echo $_COOKIE['AH'];?></li>
    <li>Height BH: <?php echo $_COOKIE['BH'];?></li>
    <li>Height CH: <?php echo $_COOKIE['CH'];?></li>
</ul>
<ul>
    <li>Perimeter: <?php echo $_COOKIE['P'];?></li>
    <li>Surface: <?php echo $_COOKIE['S'];?></li>
    <li>Inner Radius: <?php echo $_COOKIE['IR'];?></li>
    <li>Outer Radius: <?php echo $_COOKIE['OR'];?></li>
</ul>

<style>
    <?php include 'Styles/navbar.css' ?>
    <?php include '../Styles/navbar.css' ?>
</style>
</body>
</html>
