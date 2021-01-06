<?php


namespace Controller;

use FigureContainers\Triangle;
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

        if($this->validateNumber($AB) ||
            $this->validateNumber($BC) ||
            $this->validateNumber($AC) ||
            $this->validateNumber($A) ||
            $this->validateNumber($B) ||
            $this->validateNumber($C) ||
            $this->validateNumber($AL) ||
            $this->validateNumber($BL) ||
            $this->validateNumber($CL) ||
            $this->validateNumber($AM) ||
            $this->validateNumber($BM) ||
            $this->validateNumber($CM) ||
            $this->validateNumber($AH) ||
            $this->validateNumber($BH) ||
            $this->validateNumber($CH) ||
            $this->validateNumber($P) ||
            $this->validateNumber($S) ||
            $this->validateNumber($R) ||
            $this->validateNumber($r)
        ){
            View::render('triangle');
            echo json_encode("No negative values please.");
            return $result;
        }

        $triangle = new Triangle();

    }

    public function validateNumber($number){
        return $number <= 0;
    }
}