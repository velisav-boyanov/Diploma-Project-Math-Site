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

        $given = json_decode($_SESSION['Given']);

        $AB = $_POST['AB'] ?? $given[self::SIDE_AB] ?? '';
        $AC = $_POST['AC'] ?? $given[self::SIDE_AC] ?? '';
        $BC = $_POST['BC'] ?? $given[self::SIDE_BC] ?? '';

        $A = $_POST['A'] ?? $given[self::ANGLE_A] ?? '';
        $B = $_POST['B'] ?? $given[self::ANGLE_B] ?? '';
        $C = $_POST['C'] ?? $given[self::ANGLE_C] ?? '';

        $AL = $_POST['AL'] ?? $given[self::BISECTOR_AL] ?? '';
        $BL = $_POST['BL'] ?? $given[self::BISECTOR_BL] ?? '';
        $CL = $_POST['CL'] ?? $given[self::BISECTOR_CL] ?? '';

        $AM = $_POST['AM'] ?? $given[self::MEDIAN_AM] ?? '';
        $CM = $_POST['CM'] ?? $given[self::MEDIAN_BM] ?? '';
        $BM = $_POST['BM'] ?? $given[self::MEDIAN_CM] ?? '';

        $AH = $_POST['AH'] ?? $given[self::HEIGHT_AH] ?? '';
        $BH = $_POST['BH'] ?? $given[self::HEIGHT_BH] ?? '';
        $CH = $_POST['CH'] ?? $given[self::HEIGHT_CH] ?? '';

        $P = $_POST['P'] ?? $given[self::PERIMETER] ?? '';
        $S = $_POST['S'] ?? $given[self::SURFACE] ?? '';

        $R = $_POST['RLarge'] ?? $given[self::OUTER_RADIUS] ?? '';
        $r = $_POST['RSmall'] ?? $given[self::INNER_RADIUS] ?? '';

        $ALFromB = $_POST['ALFromB'] ?? $given[self::SIDE_AL_FROM_B] ?? '';
        $CLFromB = $_POST['CLFromB'] ?? $given[self::SIDE_CL_FROM_B] ?? '';
        $ALFromC = $_POST['ALFromC'] ?? $given[self::SIDE_AL_FROM_C] ?? '';
        $BLFromC = $_POST['BLFromC'] ?? $given[self::SIDE_BL_FROM_C] ?? '';
        $BLFromA = $_POST['BLFromA'] ?? $given[self::SIDE_BL_FROM_A] ?? '';
        $CLFromA = $_POST['CLFromA'] ?? $given[self::SIDE_CL_FROM_A] ?? '';

        //clean POST AND SESSION GIVEN
        $_POST = array();
        unset($_SESSION['Given']);

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

    public function run($triangleFill): bool
    {
        $result = false;

        $stuck = true;
        //what formulas were used to find the sides.
        $text = "";
        $triangle = new FigureTriangle($triangleFill);
        //finds sides based on given parameters
//        do {
//            break;
//        } while ($stuck != true);

        if(!$this->validateSides($triangle->getParameter(self::SIDE_AB), $triangle->getParameter(self::SIDE_BC), $triangle->getParameter(self::SIDE_AC))){
            View::render('triangle');
            echo json_encode("Impossible side proportions.");
            return $result;
        }
        //find everything else based on sides;
        if($triangle->getParameter(self::SIDE_AB) && $triangle->getParameter(self::SIDE_AC) && $triangle->getParameter(self::SIDE_BC)) {
            $triangle->setEverythingFromSides();
            setcookie("HowWasItSolved", $text . "Using the sides we can find everything else using the analogous formulas(you can find them on the main page)." ,time()+3600);
        }

        $triangle->sendCookies();


        View::redirect('../../Diploma-Project-Math-Site/View/triangleResult.php', 301);
        return true;
    }


    public function validateNumber($number): bool
    {
        return $number > 0;
    }

    public function validateSides($a, $b, $c): bool
    {
        if($a == "" || $b == "" || $c == ""){
            return true;
        }
        if(($a + $b <= $c) || ($a + $c <= $b) || ($b + $c <= $a)){
            return false;
        }
        return true;
    }
}