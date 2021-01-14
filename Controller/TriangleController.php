<?php


namespace Controller;

use FigureContainers\FigureTriangle;
use Core\View;
use mysql_xdevapi\BaseResult;

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
            return $result;
        }else{
            $triangle =  ["start", $AB, $AC, $BC, $A, $B, $C, $S, $P, $r, $R, $AM, $BM, $CM, $AL, $BL, $CL, $ALFromB, $CLFromB, $ALFromC, $BLFromC, $BLFromA, $CLFromA, $AH, $BH, $CH];
            $this->run($triangle);
            return true;
        }

    }

    public function run($triangleFill){
        $result['success'] = false;

        $stuck = true;
        $triangle = new FigureTriangle($triangleFill);
        $triangle->setValuesAreSet();
        //finds sides based on given parameters
//        do {
//            break;
//        } while ($stuck != true);

        //find everything else based on sides;
        if($triangle->valuesAreSet['AB'] && $triangle->valuesAreSet['AC'] && $triangle->valuesAreSet['BC']) {
            $triangle->angleC = $triangle->cosTheoremForAngle($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);
            $triangle->angleB = $triangle->cosTheoremForAngle($triangle->sideAC, $triangle->sideBC, $triangle->sideAB);
            $triangle->angleA = $triangle->cosTheoremForAngle($triangle->sideBC, $triangle->sideAB, $triangle->sideAC);

            $triangle->medianCM = $triangle->medianFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);
            $triangle->medianBM = $triangle->medianFromSides($triangle->sideAC, $triangle->sideBC, $triangle->sideAB);
            $triangle->medianAM = $triangle->medianFromSides($triangle->sideBC, $triangle->sideAB, $triangle->sideAC);

            $triangle->bisectorAL = $triangle->bisectorFromSidesAndAngleCos($triangle->sideAC, $triangle->sideAB, $triangle->angleA);
            $triangle->bisectorCL = $triangle->bisectorFromSidesAndAngleCos($triangle->sideAC, $triangle->sideBC, $triangle->angleC);
            $triangle->bisectorBL = $triangle->bisectorFromSidesAndAngleCos($triangle->sideAB, $triangle->sideBC, $triangle->angleB);

            $triangle->perimeter = $triangle->perimeterFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);
            $triangle->surface = $triangle->surfaceFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);

            $triangle->innerRadius = $triangle->smallRadiusFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);
            $triangle->outerRadius = $triangle->largeRadiusFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);

            $triangle->heightCH = $triangle->heightFromSides($triangle->sideAC, $triangle->sideBC, $triangle->sideAB);
            $triangle->heightBH = $triangle->heightFromSides($triangle->sideAB, $triangle->sideBC, $triangle->sideAC);
            $triangle->heightAH = $triangle->heightFromSides($triangle->sideAC, $triangle->sideAB, $triangle->sideBC);
        }
        View::render('main');
        echo json_encode($triangle->angleA); echo json_encode($triangle->angleB); echo json_encode($triangle->angleC);echo PHP_EOL;
        echo json_encode($triangle->medianAM); echo json_encode($triangle->medianBM); echo json_encode($triangle->medianCM);echo PHP_EOL;
        echo json_encode($triangle->bisectorAL); echo json_encode($triangle->bisectorBL); echo json_encode($triangle->bisectorCL);echo PHP_EOL;
        echo json_encode($triangle->heightAH); echo json_encode($triangle->heightBH); echo json_encode($triangle->heightCH);echo PHP_EOL;
    }

    public function validateNumber($number){
        return $number > 0;
    }
}