<?php

namespace FigureContainers;
class FigureTriangle
{
    //Sides
    public $sideAB;
    public $sideAC;
    public $sideBC;

    //Angles THE ANGLES SHOULD ALWAYS BE TURNED IN TO COS, IMPORTANT !!!!!!!!!!!!!
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

    public $valuesAreSet;

    /**
     * FigureTriangle constructor.
     * @param $triangleFill
     */

    public function __construct($triangleFill)
    {
        $this->sideAB = $triangleFill[1];
        $this->sideAC = $triangleFill[2];
        $this->sideBC = $triangleFill[3];
        $this->angleA = $triangleFill[4];
        $this->angleB = $triangleFill[5];
        $this->angleC = $triangleFill[6];
        $this->surface = $triangleFill[7];
        $this->perimeter = $triangleFill[8];
        $this->innerRadius = $triangleFill[9];
        $this->outerRadius = $triangleFill[10];
        $this->medianAM = $triangleFill[11];
        $this->medianBM = $triangleFill[12];
        $this->medianCM = $triangleFill[13];
        $this->bisectorAL = $triangleFill[14];
        $this->bisectorBL = $triangleFill[15];
        $this->bisectorCL = $triangleFill[16];
        $this->sideALFromB = $triangleFill[17];
        $this->sideCLFromB = $triangleFill[18];
        $this->sideALFromC = $triangleFill[19];
        $this->sideBLFromC = $triangleFill[20];
        $this->sideBLFromA = $triangleFill[21];
        $this->sideCLFromA = $triangleFill[22];
        $this->heightAH = $triangleFill[23];
        $this->heightBH = $triangleFill[24];
        $this->heightCH = $triangleFill[25];
        if(($triangleFill[1] == $triangleFill[2]) && ($triangleFill[3] == $triangleFill[2])){
            $this->isEquilateral = true;
        }

        if($triangleFill[4] == 90 || $triangleFill[5] == 90 || $triangleFill[6] == 90){
            $this->isRight = true;
        }

        if($triangleFill[4] > 90 || $triangleFill[5] > 90 || $triangleFill[6] > 90) {
            $this->isObtuse = true;
        }
        if(($triangleFill[1] == $triangleFill[2]) && ($triangleFill[3] == $triangleFill[2])) {
            $this->isIsosceles = true;
        }
    }


    public function setValuesAreSet(){
        if($this->sideAB == ''){
            $this->valuesAreSet['AB'] = false;
        }else{
            $this->valuesAreSet['AB'] = true;
        }
        if($this->sideAC == ''){
            $this->valuesAreSet['AC'] = false;
        }else{
            $this->valuesAreSet['AC'] = true;
        }
        if($this->sideBC == ''){
            $this->valuesAreSet['BC'] = false;
        }else{
            $this->valuesAreSet['BC'] = true;
        }
        if($this->angleA == ''){
            $this->valuesAreSet['A'] = false;
        }else{
            $this->valuesAreSet['A'] = true;
        }
        if($this->angleB == ''){
            $this->valuesAreSet['B'] = false;
        }else{
            $this->valuesAreSet['B'] = true;
        }
        if($this->angleC == ''){
            $this->valuesAreSet['C'] = false;
        }else{
            $this->valuesAreSet['C'] = true;
        }

        if($this->medianAM == ''){
            $this->valuesAreSet['AM'] = false;
        }else{
            $this->valuesAreSet['AM'] = true;
        }
        if($this->medianBM == ''){
            $this->valuesAreSet['BM'] = false;
        }else{
            $this->valuesAreSet['BM'] = true;
        }
        if($this->medianCM == ''){
            $this->valuesAreSet['CM'] = false;
        }else{
            $this->valuesAreSet['CM'] = true;
        }

        if($this->bisectorAL == ''){
            $this->valuesAreSet['AL'] = false;
        }else{
            $this->valuesAreSet['AL'] = true;
        }
        if($this->bisectorBL == ''){
            $this->valuesAreSet['BL'] = false;
        }else{
            $this->valuesAreSet['BL'] = true;
        }
        if($this->bisectorCL == ''){
            $this->valuesAreSet['CL'] = false;
        }else{
            $this->valuesAreSet['CL'] = true;
        }

        if($this->heightAH == ''){
            $this->valuesAreSet['AH'] = false;
        }else{
            $this->valuesAreSet['AH'] = true;
        }
        if($this->heightBH == ''){
            $this->valuesAreSet['BH'] = false;
        }else{
            $this->valuesAreSet['BH'] = true;
        }
        if($this->heightCH == ''){
            $this->valuesAreSet['CH'] = false;
        }else{
            $this->valuesAreSet['CH'] = true;
        }

        if($this->outerRadius == ''){
            $this->valuesAreSet['OR'] = false;
        }else{
            $this->valuesAreSet['OR'] = true;
        }
        if($this->innerRadius == ''){
            $this->valuesAreSet['IR'] = false;
        }else{
            $this->valuesAreSet['IR'] = true;
        }
        if($this->surface == ''){
            $this->valuesAreSet['S'] = false;
        }else{
            $this->valuesAreSet['S'] = true;
        }
        if($this->perimeter == ''){
            $this->valuesAreSet['P'] = false;
        }else{
            $this->valuesAreSet['P'] = true;
        }

        if($this->sideALFromB == ''){
            $this->valuesAreSet['ALFromB'] = false;
        }else{
            $this->valuesAreSet['ALFromB'] = true;
        }
        if($this->sideCLFromB == ''){
            $this->valuesAreSet['CLFromB'] = false;
        }else{
            $this->valuesAreSet['CLFromB'] = true;
        }
        if($this->sideALFromC == ''){
            $this->valuesAreSet['ALFromC'] = false;
        }else{
            $this->valuesAreSet['ALFromC'] = true;
        }
        if($this->sideBLFromC == ''){
            $this->valuesAreSet['BLFromC'] = false;
        }else{
            $this->valuesAreSet['BLFromC'] = true;
        }
        if($this->sideBLFromA == ''){
            $this->valuesAreSet['BLFromA'] = false;
        }else{
            $this->valuesAreSet['BLFromA'] = true;
        }
        if($this->sideCLFromA == ''){
            $this->valuesAreSet['CLFromA'] = false;
        }else{
            $this->valuesAreSet['CLFromA'] = true;
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
        $this->surface= sqrt($p*($p-$side1)*
            ($p-$side3)*
            ($p-$side2));
        return $s = sqrt($p*($p-$side1)*
            ($p-$side3)*
            ($p-$side2));
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
        return $s = (pow($side1, 2)*
                sin($angle2)*
                sin($angle3))/
            (2*sin($angle1));
    }

    public function surfaceFromSideAndR($side1, $side2, $side3, $R){
        $this->surface= ($side1*$side2*$side3)/
            (4*$R);
        return $s = ($side1*$side2*$side3)/
            (4*$R);
    }

    public function surfaceFromSideAndRSmall($side1, $side2, $side3, $r){
        $this->surface=$this->pFromSides($side1, $side2, $side3)*$r;
        return $s = $this->pFromSides($side1, $side2, $side3)*$r;
    }

    public function perimeterFromSides($side1, $side2, $side3){
        $this->perimeter = $side3+$side2+$side1;
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

}