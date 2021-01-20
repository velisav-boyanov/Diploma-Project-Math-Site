<?php


namespace Controller;

use FigureContainers\FigureTriangle;
use Core\View;

class TriangleController
{
    //Sides
    const SIDE_AB = 0;
    const SIDE_AC = 1;
    const SIDE_BC = 2;

    //Angles THE ANGLES SHOULD ALWAYS BE TURNED IN TO COS, IMPORTANT !!!!!!!!!!!!!
    const ANGLE_A = 3;
    const ANGLE_B = 4;
    const ANGLE_C = 5;
    //OverAll
    const SURFACE = 6;
    const PERIMETER = 7;

    //Radius
    const INNER_RADIUS = 8;
    const OUTER_RADIUS = 9;

    //Medians
    const MEDIAN_AM = 10;
    const MEDIAN_BM = 11;
    const MEDIAN_CM = 12;

    //Bisectors
    const BISECTOR_AL = 13;
    const BISECTOR_BL = 14;
    const BISECTOR_CL = 15;

    //SideCutBisector
    const SIDE_AL_FROM_B = 16;
    const SIDE_CL_FROM_B = 17;
    const SIDE_AL_FROM_C = 18;
    const SIDE_BL_FROM_C = 19;
    const SIDE_BL_FROM_A = 20;
    const SIDE_CL_FROM_A = 21;

    //Heights
    const HEIGHT_AH = 22;
    const HEIGHT_BH = 23;
    const HEIGHT_CH = 24;

    //Empty
    const EMPTY = "";

    public function fillTriangle(){
        $result = [
            'success' => false
        ];

        $AB = $_POST['AB'] ?? '';
        $AC = $_POST['AC'] ?? '';
        $BC = $_POST['BC'] ?? '';

        $A = $_POST['A'] ?? '';
        $B = $_POST['B'] ?? '';
        $C = $_POST['C'] ?? '';

        $AL = $_POST['AL'] ?? '';
        $BL = $_POST['BL'] ?? '';
        $CL = $_POST['CL'] ?? '';

        $AM = $_POST['AM'] ?? '';
        $CM = $_POST['CM'] ?? '';
        $BM = $_POST['BM'] ?? '';

        $AH = $_POST['AH'] ?? '';
        $BH = $_POST['BH'] ?? '';
        $CH = $_POST['CH'] ?? '';

        $P = $_POST['P'] ?? '';
        $S = $_POST['S'] ?? '';

        $R = $_POST['RLarge'] ?? '';
        $r = $_POST['RSmall'] ?? '';

        $ALFromB = $_POST['ALFromB'] ?? '';
        $CLFromB = $_POST['CLFromB'] ?? '';
        $ALFromC = $_POST['ALFromC'] ?? '';
        $BLFromC = $_POST['BLFromC'] ?? '';
        $BLFromA = $_POST['BLFromA'] ?? '';
        $CLFromA = $_POST['CLFromA'] ?? '';

        if(!$this->validateNumber($AB) &&
            !$this->validateNumber($AC) &&
            !$this->validateNumber($A) &&
            !$this->validateNumber($B) &&
            !$this->validateNumber($C) &&
            !$this->validateNumber($AL) &&
            !$this->validateNumber($BL) &&
            !$this->validateNumber($CL) &&
            !$this->validateNumber($AM) &&
            !$this->validateNumber($BM) &&
            !$this->validateNumber($CM) &&
            !$this->validateNumber($AH) &&
            !$this->validateNumber($BH) &&
            !$this->validateNumber($CH) &&
            !$this->validateNumber($P) &&
            !$this->validateNumber($S) &&
            !$this->validateNumber($R) &&
            !$this->validateNumber($r) &&
            !$this->validateNumber($ALFromB) &&
            !$this->validateNumber($CLFromB) &&
            !$this->validateNumber($ALFromC) &&
            !$this->validateNumber($BLFromC) &&
            !$this->validateNumber($CLFromA) &&
            !$this->validateNumber($BLFromA)
        ){
            View::render('triangle');
            echo json_encode("No negative values.");
            return $result;
        }else{
            $triangle =  [$AB, $AC, $BC, $A, $B, $C, $S, $P, $r, $R, $AM, $BM, $CM, $AL, $BL, $CL, $ALFromB, $CLFromB, $ALFromC, $BLFromC, $BLFromA, $CLFromA, $AH, $BH, $CH];
            $this->run($triangle);
            return true;
        }

    }

    public function run($triangleFill){
        $result = false;

        $stuck = true;
        //what formulas were used to find the sides.
        $text = "";
        $triangle = new FigureTriangle($triangleFill);
        //finds sides based on given parameters
//        do {
//            break;
//        } while ($stuck != true);

        if(!$this->validateSides($triangle->triangleParameters[self::SIDE_AB], $triangle->triangleParameters[self::SIDE_BC], $triangle->triangleParameters[self::SIDE_AC])){
            View::render('triangle');
            echo json_encode("Impossible side proportions.");
            return $result;
        }
        //find everything else based on sides;
        if($triangle->triangleParameters[self::SIDE_AB] && $triangle->triangleParameters[self::SIDE_AC] && $triangle->triangleParameters[self::SIDE_BC]) {
            $triangle->setEverythingFromSides();
            setcookie("HowWasItSolved", $text . "Using the sides we can find everything else using the analogous formulas(you can find them on the main page)." ,time()+3600);
        }

        $triangle->sendCookies();

        View::redirect('View/triangleResult.php', 301);
    }

    public function validateNumber($number){
        return $number > 0;
    }

    public function validateSides($a, $b, $c){
        if($a == "" || $b == "" || $c == ""){
            return true;
        }
        if(($a + $b < $c) || ($a + $c < $b) || ($b + $c < $a)){
            return false;
        }
        return true;
    }
}