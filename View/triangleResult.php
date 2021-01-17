<!DOCTYPE html>
<html lang="en">

<body>

<div class="navbar">
    <a href="View/triangle.php">Triangle</a>
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

<h3>Info about the site.</h3>

<script src = "JavaScript/three.js"></script>
<script>
    //scene set up
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);

    const renderer = new THREE.WebGL1Renderer({
        antialias: true
    });

    renderer.setSize((window.innerWidth/5), (window.innerHeight/3));

    document.body.appendChild(renderer.domElement);

    window.addEventListener('resize', () => {
        renderer.setSize((window.innerWidth/5), (window.innerHeight/3));
        camera.aspect = (window.innerWidth/window.innerHeight);

        camera.updateProjectionMatrix();
    })

    //triangle
    const geom = new THREE.Geometry();

    geom.vertices.push(new THREE.Vector3(0, 0, 0));//side ac
    geom.vertices.push(new THREE.Vector3(9, 0, 0));//side bc
    geom.vertices.push(new THREE.Vector3(6, 3, 0));//side ab

    geom.faces.push(new THREE.Face3(0, 1, 2));
    const material = new THREE.MeshBasicMaterial({
        color: 0x0000ff
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
