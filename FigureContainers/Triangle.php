<?php

namespace FigureContainers;
class Triangle
{
    //Sides
    public $sideAB;
    public $sideAC;
    public $sideBC;

    //Angles
    public $angleA;
    public $angleB;
    public $angleC;

    //OverAll
    public $surface;
    public $perimeter;

    //Radius
    public $innerRadius;
    public $outerRadius;

    //Medians
    public $medianAM;
    public $medianBM;
    public $medianCM;

    //Bisectors
    public $bisectorAL;
    public $bisectorBL;
    public $bisectorCL;

    //SideCutBisector
    public $sideALFromB;
    public $sideCLFromB;
    public $sideALFromC;
    public $sideBLFromC;
    public $sideBLFromA;
    public $sideCLFromA;

    //Heights
    public $heightAH;
    public $heightBH;
    public $heightCH;

    //Types
    public $isEquilateral;//all sides are equal.
    public $isAcute;//all angles are "sharp".
    public $isRight;//has one right angle;
    public $isObtuse;//has an angle larger than 90 deg.
    public $isIsosceles;//has two equal sides.

    /**
     * Triangle constructor.
     * @param $sideAB
     * @param $sideAC
     * @param $sideBC
     * @param $angleA
     * @param $angleB
     * @param $angleC
     * @param $surface
     * @param $perimeter
     * @param $innerRadius
     * @param $outerRadius
     * @param $medianAM
     * @param $medianBM
     * @param $medianCM
     * @param $bisectorAL
     * @param $bisectorBL
     * @param $bisectorCL
     * @param $sideALFromB
     * @param $sideCLFromB
     * @param $sideALFromC
     * @param $sideBLFromC
     * @param $sideBLFromA
     * @param $sideCLFromA
     * @param $heightAH
     * @param $heightBH
     * @param $heightCH
     */

    public function __construct($sideAB, $sideAC, $sideBC, $angleA, $angleB, $angleC, $surface, $perimeter, $innerRadius, $outerRadius, $medianAM, $medianBM, $medianCM, $bisectorAL, $bisectorBL, $bisectorCL, $sideALFromB, $sideCLFromB, $sideALFromC, $sideBLFromC, $sideBLFromA, $sideCLFromA, $heightAH, $heightBH, $heightCH)
    {
        $this->sideAB = $sideAB;
        $this->sideAC = $sideAC;
        $this->sideBC = $sideBC;
        $this->angleA = $angleA;
        $this->angleB = $angleB;
        $this->angleC = $angleC;
        $this->surface = $surface;
        $this->perimeter = $perimeter;
        $this->innerRadius = $innerRadius;
        $this->outerRadius = $outerRadius;
        $this->medianAM = $medianAM;
        $this->medianBM = $medianBM;
        $this->medianCM = $medianCM;
        $this->bisectorAL = $bisectorAL;
        $this->bisectorBL = $bisectorBL;
        $this->bisectorCL = $bisectorCL;
        $this->sideALFromB = $sideALFromB;
        $this->sideCLFromB = $sideCLFromB;
        $this->sideALFromC = $sideALFromC;
        $this->sideBLFromC = $sideBLFromC;
        $this->sideBLFromA = $sideBLFromA;
        $this->sideCLFromA = $sideCLFromA;
        $this->heightAH = $heightAH;
        $this->heightBH = $heightBH;
        $this->heightCH = $heightCH;
        if(($sideAB == $sideAC) && ($sideBC == $sideAC)){
            $this->isEquilateral = true;
        }

        if($angleA == 90 || $angleB == 90 || $angleC == 90){
            $this->isRight = true;
        }

        if($angleA > 90 || $angleB > 90 || $angleC > 90) {
            $this->isObtuse = true;
        }
        if(($sideAB == $sideAC) && ($sideBC == $sideAC)) {
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
        return $angleCos = (-pow($side1, 2) + (pow($side2, 2) + pow($side3, 2)))/ (2*$side2*$side3);
    }

    public function cosTheoremForSideOppositeOfAngle($angle, $side2, $side3){
        //the first side is the one opposite to the angle
        return $side1 = sqrt(pow($side3, 2) + pow($side2, 2) - 2*$side2*$side3*cos($angle));
    }

    public function cosTheoremForSideOpposite($angle, $side1, $side2){
        //the first side is the one opposite to the angle
        return $side3 = sqrt(pow($side1, 2) - pow($side2, 2) - 2*$side1*$side2*cos($angle));
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
        return $median = sqrt(2*pow($side2, 2) + 2*pow($side3, 2) - pow($side1, 2))/ 2;
    }

    public function sideFromMedianOpposite($median, $side2, $side3){
        //the first side is the on being crossed by the median
        return $side = sqrt(2*pow($side2, 2) + 2*pow($side3, 2) - 4*pow($median, 2));
    }

    public function sideFromMedianNonOpposite($side1, $side2, $median){
        //the first side is the on being crossed by the median
        return $side3 = sqrt(-2*pow($side2, 2) + pow($side1, 2) + pow($median, 2));
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
        return $bisector = (2*$side3*$side2*cos($angle/2))/($side3+$side2);
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
        $this->surface= sqrt($p*($p-$side1)*($p-$side3)*($p-$side2));
        return $s = sqrt($p*($p-$side1)*($p-$side3)*($p-$side2));
    }

    public function surfaceFromSideAndHeight($side, $height){
        $this->surface= ($side*$height)/2;
        return $s = ($side*$height)/2;
    }

    public function surfaceFromSidesAndAngle($angle, $side1, $side2){
        $this->surface= ($side2*$side2*sin($angle))/2;
        return $s = ($side2*$side2*sin($angle))/2;
    }

    public function surfaceFromAnglesAndSide($angle1, $angle2, $angle3, $side1){
        $this->surface=(pow($side1, 2)*sin($angle2)*sin($angle3))/(2*sin($angle1));
        return $s = (pow($side1, 2)*sin($angle2)*sin($angle3))/(2*sin($angle1));
    }

    public function surfaceFromSideAndR($side1, $side2, $side3, $R){
        $this->surface= ($side1*$side2*$side3)/(4*$R);
        return $s = ($side1*$side2*$side3)/(4*$R);
    }

    public function surfaceFromSideAndRSmall($side1, $side2, $side3, $r){
        $this->surface=$this->pFromSides($side1, $side2, $side3)*$r;
        return $s = $this->pFromSides($side1, $side2, $side3)*$r;
    }

    public function perimeterFromSides($side1, $side2, $side3){
        $this->perimeter = $side3+$side2+$side1;
        return $p = $side3+$side2+$side1;
    }
}