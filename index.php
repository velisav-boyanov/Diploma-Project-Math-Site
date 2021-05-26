<?php
require __DIR__ . '/vendor/autoload.php';
session_start();
spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    require_once $class;
});

$fileNotFoundFlag = false;
$controllerName = isset($_GET["target"]) ? $_GET["target"] : "index";
$methodName = isset($_GET["action"]) ? $_GET["action"] : "home";
$argument = isset($_GET["argument"]) ? $_GET["argument"] : -1;
$user = isset($_SESSION['UserId']);
$needAuth = array(
  "comment",
  "test",
  "triangleSave"
);
$userAuth = array(
    "loadOldTests",
    "loadLogin",
    "getById",
    "getAll",
    "validateUserName",
    "validatePassword"
);

$controllerClassName = "\\Controller\\" . ucfirst($controllerName) . "Controller";

if (!$user && (in_array($controllerName, $needAuth) || in_array($methodName, $userAuth))) {
        header('Refresh: 0; url=http://localhost/Diploma-Project-Math-Site/View/main.php');
        echo '<script> alert("Log in to use this feature") </script>';
}

if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName();
    if (method_exists($controller, $methodName) && $argument == -1) {
        $controller->$methodName();
    } elseif (method_exists($controller, $methodName) && $argument != -1) {
        $controller->$methodName($argument);
    } else {
        $controller = new Controller\IndexController();
        $controller->error(404);
    }
} else {
    $fileNotFoundFlag = true;
}

if ($fileNotFoundFlag) {
    $controller->error(404);
}
