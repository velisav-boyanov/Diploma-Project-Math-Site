<!DOCTYPE html>
<html lang="en">

<body>

<?php

use Controller\CommentController;
use Controller\TestController;
use Controller\TriangleSaveController;
use FigureContainers\FigureTriangle;

$test = new TestController();
$exercises = $test->getById($_SESSION['TestId']);
$exercises = str_replace("[", "", $exercises[0]["Exercises"]);
$exercises = str_replace("]", "", $exercises);
$exercises = explode(",", $exercises);
$exercises = str_replace(chr(34), "", $exercises);
$counter = 1;
?>

<h3>Exam, Questions: <?php echo sizeof($exercises)+1;?></h3>

<div class="row">
    <?php foreach ($exercises as $i) {
        $save = new TriangleSaveController();
        $post = $save->getById((int)$i);
        $post = $post['$post']['triangle'];
        ?>
        <div>
            <div class = "card-body">
                <h4 class = "card-title"><?php echo "Exercises " . $counter . "</br>" . $post['Type'];
                $counter++;?></h4>
                <p class = "card-text">
                    <?php
                    if ($post['SolvingText']) {
                        $given = array();
                        foreach (json_decode($post['Given']) as $f) {
                            $params = json_decode($post["Parameters"]);
                            $element = TriangleSaveController::PARAMETERS[$f] . "=" . $params[$f];
                            array_push($given, $element);
                        }
                        $given = implode(",", $given);
                        echo $given;
                    } else {
                        echo $post['Given'];
                    }
                    ?>
                </p>
                <p class = "card-text"><?php
                if ($post['SolvingText'] != '') {
                    echo "Find everything else";
                } else {
                    echo "Find:" . $post['Parameters'];
                }
                ?></p>
            </div>
        </div>
    <?php }?>
</div>


</body>
</html>