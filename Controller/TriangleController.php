<?php


namespace Controller;

use FigureContainers\FigureTriangle;
use Core\View;

class TriangleController
{
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
            return -1;
        }else{
            $triangle =  new FigureTriangle($AB, $AC, $BC, $A, $B, $C, $S, $P, $r, $R, $AM, $BM, $CM, $AL, $BL, $CL, $ALFromB, $CLFromB, $ALFromC, $BLFromC, $BLFromA, $CLFromA, $AH, $BH, $CH);
            $this->run($triangle);
        }

    }

    public function run($triangle){

//        if(!($triangle === -1)){
//            return false;
//        }
//        $stuck = true;
//        do{
//            break;
//        } while ($stuck!=true);

        View::render('main');
        echo json_encode("Lmao it works");
    }

    public function validateNumber($number){
        return $number > 0;
    }
}