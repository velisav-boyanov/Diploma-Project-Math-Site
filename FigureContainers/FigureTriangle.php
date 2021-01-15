<?php

namespace FigureContainers;
use Controller\TriangleController;

class FigureTriangle
{
    public array $triangleParameters;
    public bool $isEquilateral;
    public bool $isRight;
    public bool $isIsosceles;
    //public $valuesAreSet;

    /**
     * FigureTriangle constructor.
     * @param $thisFill
     */

    public function __construct($thisFill)
    {
        for($i = 0; $i < sizeof($thisFill); $i++){
            $this->triangleParameters[$i] = $thisFill[$i];
        }

        if(($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_AC]) && ($thisFill[TriangleController::SIDE_BC] == $thisFill[TriangleController::SIDE_AC])){
            $this->isEquilateral = true;
        }

        if($thisFill[TriangleController::ANGLE_A] == 90 || $thisFill[TriangleController::ANGLE_B] == 90 || $thisFill[TriangleController::ANGLE_C] == 90){
            $this->isRight = true;
        }

        if(($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_AC]) || ($thisFill[TriangleController::SIDE_BC] == $thisFill[TriangleController::SIDE_AC]) || ($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_BC])) {
            $this->isIsosceles = true;
        }
    }

    //formulas
    public function angleFromTwoOthers($angle1, $angle2){
        return $angle = 180 - ($angle1 + $angle2);
    }

    public function cosTheoremForAngle($side1, $side2, $side3){
        //the first side is the one opposite to the angle
        //returns cos
        return $angleCos = (-pow($side1, 2) +
                (pow($side2, 2) + pow($side3, 2)))/
            (2*$side2*$side3);
    }

    public function cosTheoremForSideOppositeOfAngle($angle, $side2, $side3){
        //the first side is the one opposite to the angle
        return $side1 = sqrt(pow($side3, 2) +
            pow($side2, 2) -
            2*$side2*$side3*cos($angle));
    }

    public function cosTheoremForSideOpposite($angle, $side1, $side2){
        //the first side is the one opposite to the angle
        return $side3 = sqrt(pow($side1, 2) -
            pow($side2, 2) -
            2*$side1*$side2*cos($angle));
    }

    public function sinTheoremForAngle($side, $R){
        //returns sin
        return $angle = $side/ (2*$R);
    }

    public function sinTheoremForSide($angle, $R){
        //returns side opposite of angle
        return $side = sin($angle)*2*$R;
    }

    public function sinTheoremForR($side, $angle){
        //returns sin
        return $angle = $side/(2*sin($angle));
    }

    public function medianFromSides($side1, $side2, $side3){
        //the first side is the on being crossed by the median
        return $median = sqrt(2*pow($side2, 2) +
                2*pow($side3, 2) -
                pow($side1, 2))/ 2;
    }

    public function sideFromMedianOpposite($median, $side2, $side3){
        //the first side is the on being crossed by the median
        return $side = sqrt(2*pow($side2, 2) +
            2*pow($side3, 2) -
            4*pow($median, 2));
    }

    public function sideFromMedianNonOpposite($side1, $side2, $median){
        //the first side is the on being crossed by the median
        return $side3 = sqrt(-2*pow($side2, 2) +
            pow($side1, 2) +
            pow($median, 2));
    }

    public function bisectorFromSides($side12, $side11, $side2, $side3){
        return $bisector = sqrt($side2*$side3 - $side11*$side12);
    }

    public function sideFragmentFromSide($side11, $side2, $side3){
        return $side12 = ($side11*$side2)/$side3;
    }

    public function sideFromBisectorFragments($side11, $side12, $side2){
        return $side3 = ($side11*$side2)/$side12;
    }

    public function bisectorFromSidesAndAngle($side2, $side3, $angle){
        return $bisector = (2*$side3*$side2*
                cos($angle/2))/
            ($side3+$side2);
    }

    public function bisectorFromSidesAndAngleCos($side2, $side3, $angleCos){
        $angleCosHalf = sqrt((1+$angleCos)/2);
        return $bisector = (2*$side3*$side2*$angleCosHalf)/
            ($side3+$side2);
    }

    public function angleFromBisectorAndSide($side2, $side3, $bisector){
        //returns sin
        $halfAngleCos = (($side2+$side3)*$bisector)/(2*$side3*$side2);
        $halfAngleSin = sqrt(pow($halfAngleCos, 2) - 1);
        return $angle = $halfAngleCos*$halfAngleSin*2;
    }

    public function pFromSides($side1, $side2, $side3){
        return $p = ($side2+$side3+$side1)/2;
    }

    public function surfaceFromSides($side1, $side2, $side3){
        $p = $this->pFromSides($side1, $side2, $side3);
        return $s = sqrt($p*($p-$side1)*
            ($p-$side3)*
            ($p-$side2));
    }

    public function surfaceFromSideAndHeight($side, $height){
        return $s = ($side*$height)/2;
    }

    public function surfaceFromSidesAndAngle($angle, $side1, $side2){
        return $s = ($side2*$side2*sin($angle))/2;
    }

    public function surfaceFromAnglesAndSide($angle1, $angle2, $angle3, $side1){
        return $s = (pow($side1, 2)*
                sin($angle2)*
                sin($angle3))/
            (2*sin($angle1));
    }

    public function surfaceFromSideAndR($side1, $side2, $side3, $R){
        return $s = ($side1*$side2*$side3)/
            (4*$R);
    }

    public function surfaceFromSideAndRSmall($side1, $side2, $side3, $r){
        return $s = $this->pFromSides($side1, $side2, $side3)*$r;
    }

    public function perimeterFromSides($side1, $side2, $side3){
        return $p = $side3+$side2+$side1;
    }

    public function heightFromSides($side1, $side2, $side3){
        return $h3 = sqrt(($side1+$side2-$side3)*
                ($side1-$side2+$side3)*
                ($side2+$side3-$side1)*
                ($side1+$side2+$side3))
            /(2*$side3);
    }

    public function smallRadiusFromSides($side1, $side2, $side3){
        return $r = sqrt(($side1+$side2-$side3)*
            ($side1-$side2+$side3)*
            ($side2+$side3-$side1)
            /($side3+$side1+$side2));
    }

    public function largeRadiusFromSides($side1, $side2, $side3){
        return $R = ($side2*$side3*$side1)/
            sqrt(($side1+$side2-$side3)
                *($side1-$side2+$side3)
                *($side2+$side3-$side1)
                *($side1+$side2+$side3));
    }

    public function sideFromBisectorHeightMedian($bisector, $median, $height){
        //returns a', where a'>a
        return $a = 2*sqrt(pow($median, 2) - 2*pow($height, 2) + ((2*pow($height, 2) - pow($bisector, 2))*
                    sqrt((pow($median, 2) - pow($height, 2))/
                        (pow($bisector, 2) - pow($height, 2)))));
    }

    public function side1FromMedianHeightAndSide($median, $height, $side){
        return $b = intdiv(1, 2)*
            sqrt(4*pow($median, 2) + pow($side, 2) +
                $side*4*
                sqrt(pow($median, 2) - pow($height, 2)));
    }

    public function sideFromOppositeHeightSmallRadiusLargeRadius($height, $r, $R){
        $pWithoutC = ($height/(2*$r)-1);
        $sumOfSidesDividedByOtherSide = ($height - $r)/$r;

        $a = 4*$pWithoutC*(pow($pWithoutC, 2) - $pWithoutC*$sumOfSidesDividedByOtherSide);
        $b = pow($height, 2);
        $c = 2*$height*$R;

        return $this->quadraticSolver($a, $b, $c);
    }

    public function quadraticSolver($a, $b, $c){
        $t = (pow($b, 2)) - (4*$a*$c);
        if($t < 0){
            return false;
        }
        $result['x1'] = ($b+(sqrt($t))) / (2*$a);
        $result['x2'] = ($b-(sqrt($t))) / (2*$a);
        return $result;
    }

    public function setEverythingFromSides(){
        $this->triangleParameters[TriangleController::ANGLE_C] = number_format($this->cosTheoremForAngle($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::ANGLE_B] = number_format($this->cosTheoremForAngle($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB]), 3);
        $this->triangleParameters[TriangleController::ANGLE_A] = number_format($this->cosTheoremForAngle($this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_AC]), 3);

        $this->triangleParameters[TriangleController::MEDIAN_CM] = number_format($this->medianFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::MEDIAN_BM] = number_format($this->medianFromSides($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB]), 3);
        $this->triangleParameters[TriangleController::MEDIAN_AM] = number_format($this->medianFromSides($this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_AC]), 3);

        $this->triangleParameters[TriangleController::BISECTOR_AL] = number_format($this->bisectorFromSidesAndAngleCos($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::ANGLE_A]), 3);
        $this->triangleParameters[TriangleController::BISECTOR_CL] = number_format($this->bisectorFromSidesAndAngleCos($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::ANGLE_C]), 3);
        $this->triangleParameters[TriangleController::BISECTOR_BL] = number_format($this->bisectorFromSidesAndAngleCos($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::ANGLE_B]), 3);

        $this->triangleParameters[TriangleController::PERIMETER] = number_format($this->perimeterFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::SURFACE] = number_format($this->surfaceFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);

        $this->triangleParameters[TriangleController::INNER_RADIUS] = number_format($this->smallRadiusFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::OUTER_RADIUS] = number_format($this->largeRadiusFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);

        $this->triangleParameters[TriangleController::HEIGHT_CH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB]), 3);
        $this->triangleParameters[TriangleController::HEIGHT_BH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::HEIGHT_AH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC]), 3);
    }

}