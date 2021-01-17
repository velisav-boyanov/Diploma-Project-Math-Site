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
    let alk = Math.sqrt(Math.pow(bk, 2) - Math.pow(hk, 2));

    geom.vertices.push(new THREE.Vector3(-(ak/2), -3, 0));//base point(A) dose not change
    geom.vertices.push(new THREE.Vector3(ak/2, -3, 0));//base point B, dont change this point
    geom.vertices.push(new THREE.Vector3(alk-(ak/2), hk-3, 0));//point C

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
body {
    font-family: Arial, Helvetica, sans-serif;
    }
canvas {
    display: block;
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
