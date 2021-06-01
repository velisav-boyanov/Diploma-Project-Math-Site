<?php

namespace FigureContainers;

use Controller\TriangleController;

class FigureTriangle
{
    private array $triangleParameters;
    private bool $isEquilateral;
    private bool $isRight;
    private bool $isIsosceles;
    private array $givenValues;

    public function getParameter($i)
    {
        return $this->triangleParameters[$i];
    }

    /**
     * @return bool
     */
    public function isEquilateral(): bool
    {
        return $this->isEquilateral;
    }

    /**
     * @param bool $isEquilateral
     */
    public function setIsEquilateral(bool $isEquilateral): void
    {
        $this->isEquilateral = $isEquilateral;
    }

    /**
     * @return bool
     */
    public function isRight(): bool
    {
        return $this->isRight;
    }

    /**
     * @param bool $isRight
     */
    public function setIsRight(bool $isRight): void
    {
        $this->isRight = $isRight;
    }

    /**
     * @return bool
     */
    public function isIsosceles(): bool
    {
        return $this->isIsosceles;
    }

    /**
     * @param bool $isIsosceles
     */
    public function setIsIsosceles(bool $isIsosceles): void
    {
        $this->isIsosceles = $isIsosceles;
    }

    /**
     * FigureTriangle constructor.
     * @param $thisFill
     */

    public function __construct($thisFill)
    {
        $var = 0;
        for ($i = 0; $i < sizeof($thisFill); $i++) {
            $this->triangleParameters[$i] = $thisFill[$i];
            if ($thisFill[$i] != "") {
                $this->givenValues[$var] = $i;
                $var++;
            }
        }

        if (($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_AC]) && ($thisFill[TriangleController::SIDE_BC] == $thisFill[TriangleController::SIDE_AC])) {
            $this->isEquilateral = true;
        }

        if ($thisFill[TriangleController::ANGLE_A] == 90 || $thisFill[TriangleController::ANGLE_B] == 90 || $thisFill[TriangleController::ANGLE_C] == 90) {
            $this->isRight = true;
        }

        if (($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_AC]) || ($thisFill[TriangleController::SIDE_BC] == $thisFill[TriangleController::SIDE_AC]) || ($thisFill[TriangleController::SIDE_AB] == $thisFill[TriangleController::SIDE_BC])) {
            $this->isIsosceles = true;
        }
    }

    //formulas
    public function angleFromTwoOthers($angle1, $angle2)
    {
        return $angle = 180 - ($angle1 + $angle2);
    }

    public function cosTheoremForAngle($side1, $side2, $side3)
    {
        //the first side is the one opposite to the angle
        //returns cos
        return $angleCos = (-pow($side1, 2) +
                (pow($side2, 2) + pow($side3, 2)))/
            (2*$side2*$side3);
    }

    public function cosTheoremForSideOppositeOfAngle($angle, $side2, $side3)
    {
        //the first side is the one opposite to the angle
        return $side1 = sqrt(pow($side3, 2) +
            pow($side2, 2) -
            2*$side2*$side3*$angle);
    }

    public function cosTheoremForSideOpposite($angle, $side1, $side2)
    {
        //the first side is the one opposite to the angle
        $part1 = pow($side2, 2) - pow($side1, 2);
        $part2 = $angle*$side2*2;
        return $this->quadraticSolver(1, $part2, $part1);
    }

    public function sinTheoremForAngle($side, $R)
    {
        //returns cos
        return 1 - pow($angle = $side/ (2*$R), 2);
    }

    public function sinTheoremForSide($angle, $R)
    {
        //returns side opposite of angle
        return $side = (1 - pow($angle, 2))*2*$R;
    }

    public function sinTheoremForR($side, $angle)
    {
        //returns cos
        return $angle = $side/(2*(1 - pow($angle, 2)));
    }

    public function medianFromSides($side1, $side2, $side3)
    {
        //the first side is the on being crossed by the median
        return $median = sqrt(2*pow($side2, 2) +
                2*pow($side3, 2) -
                pow($side1, 2))/ 2;
    }

    public function sideFromMedianOpposite($median, $side2, $side3)
    {
        //the first side is the on being crossed by the median
        return $side = sqrt(2*pow($side2, 2) +
            2*pow($side3, 2) -
            4*pow($median, 2));
    }

    public function sideFromMedianNonOpposite($side1, $side2, $median)
    {
        //the first side is the on being crossed by the median
        return $side3 = sqrt(-2*pow($side2, 2) +
            pow($side1, 2) +
            pow($median, 2));
    }

    public function bisectorFromSides($side12, $side11, $side2, $side3)
    {
        return $bisector = sqrt($side2*$side3 - $side11*$side12);
    }

    public function sideFragmentFromSide($side11, $side2, $side3)
    {
        return $side12 = ($side11*$side2)/$side3;
    }

    public function sideFromBisectorFragments($side11, $side12, $side2)
    {
        return $side3 = ($side11*$side2)/$side12;
    }

    public function bisectorFromSidesAndAngle($side2, $side3, $angle)
    {
        return $bisector = (2*$side3*$side2*
                sqrt((1+$angle)/2))/
            ($side3+$side2);
    }

    public function bisectorFromSidesAndAngleCos($side2, $side3, $angleCos)
    {
        $angleCosHalf = sqrt((1+$angleCos)/2);
        return $bisector = (2*$side3*$side2*$angleCosHalf)/
            ($side3+$side2);
    }

    public function angleFromBisectorAndSide($side2, $side3, $bisector)
    {
        //returns cos
        $halfAngleCos = (($side2+$side3)*$bisector)/(2*$side3*$side2);
        $halfAngleSin = sqrt(pow($halfAngleCos, 2) - 1);
        return $angle = pow(1-$halfAngleCos*$halfAngleSin*2, 2);
    }

    public function pFromSides($side1, $side2, $side3)
    {
        return $p = ($side2+$side3+$side1)/2;
    }

    public function surfaceFromSides($side1, $side2, $side3): float
    {
        $p = $this->pFromSides($side1, $side2, $side3);
        return $s = sqrt($p*($p-$side1)*
            ($p-$side3)*
            ($p-$side2));
    }

    public function surfaceFromSideAndHeight($side, $height)
    {
        return $s = ($side*$height)/2;
    }

    public function surfaceFromSidesAndAngle($angle, $side1, $side2)
    {
        return $s = ($side1*$side2*(1-pow($angle, 2)))/2;
    }

    public function surfaceFromAnglesAndSide($angle1, $angle2, $angle3, $side1)
    {
        return $s = (pow($side1, 2)*
                sin($angle2)*
                sin($angle3))/
            (2*sin($angle1));
    }

    public function surfaceFromSideAndR($side1, $side2, $side3, $R)
    {
        return $s = ($side1*$side2*$side3)/
            (4*$R);
    }

    public function surfaceFromSideAndRSmall($side1, $side2, $side3, $r)
    {
        return $s = $this->pFromSides($side1, $side2, $side3)*$r;
    }

    public function perimeterFromSides($side1, $side2, $side3)
    {
        return $p = $side3+$side2+$side1;
    }

    public function heightFromSides($side1, $side2, $side3)
    {
        return $h3 = sqrt(($side1+$side2-$side3)*
                ($side1-$side2+$side3)*
                ($side2+$side3-$side1)*
                ($side1+$side2+$side3))
            /(2*$side3);
    }

    public function smallRadiusFromSides($side1, $side2, $side3): float
    {
        return $r = sqrt(($side1+$side2-$side3)*
            ($side1-$side2+$side3)*
            ($side2+$side3-$side1)
            /($side3+$side1+$side2));
    }

    public function largeRadiusFromSides($side1, $side2, $side3)
    {
        return $R = ($side2*$side3*$side1)/
            sqrt(($side1+$side2-$side3)
                *($side1-$side2+$side3)
                *($side2+$side3-$side1)
                *($side1+$side2+$side3));
    }

    public function sideFromBisectorHeightMedian($bisector, $median, $height)
    {
        //returns a', where a'>a
        return $a = 2*sqrt(pow($median, 2) - 2*pow($height, 2) + ((2*pow($height, 2) - pow($bisector, 2))*
                    sqrt((pow($median, 2) - pow($height, 2))/
                        (pow($bisector, 2) - pow($height, 2)))));
    }

    public function side2FromMedianHeightAndSide($median, $height, $side)
    {
        return $b = intdiv(1, 2)*
            sqrt(4*pow($median, 2) + pow($side, 2) +
                $side*4*
                sqrt(pow($median, 2) - pow($height, 2)));
    }

    public function side3FromMedianHeightAndSide($median, $height, $side)
    {
        return $b = intdiv(1, 2)*
            sqrt(4*pow($median, 2) + pow($side, 2) -
                $side*4*
                sqrt(pow($median, 2) - pow($height, 2)));
    }

    public function setRightAfterInit()
    {
        if ($this->triangleParameters[TriangleController::ANGLE_A] == 0 || $this->triangleParameters[TriangleController::ANGLE_B] == 0 || $this->triangleParameters[TriangleController::ANGLE_C] == 0) {
            $this->isRight = true;
        } else {
            $this->isRight = false;
        }
    }

    public function sideFromOppositeHeightSmallRadiusLargeRadius($height, $r, $R)
    {
        $pWithoutC = ($height/(2*$r)-1);
        $sumOfSidesDividedByOtherSide = ($height - $r)/$r;

        $a = 4*$pWithoutC*(pow($pWithoutC, 2) - $pWithoutC*$sumOfSidesDividedByOtherSide);
        $b = pow($height, 2);
        $c = 2*$height*$R;

        return $this->quadraticSolver($a, $b, $c);
    }

    public function quadraticSolver($a, $b, $c)
    {
        $t = (pow($b, 2)) - (4*$a*$c);
        if ($t < 0) {
            return false;
        }
        return ($b+(sqrt($t))) / (2*$a);
    }

    public function evenOut()
    {
        foreach ($this->triangleParameters as $i) {
            $i = round($i, 2);
        }
    }

    public function setEverythingFromSides()
    {
        $this->triangleParameters[TriangleController::SIDE_AB] = number_format($this->triangleParameters[TriangleController::SIDE_AB], 3);
        $this->triangleParameters[TriangleController::SIDE_AC] = number_format($this->triangleParameters[TriangleController::SIDE_AC], 3);
        ;
        $this->triangleParameters[TriangleController::SIDE_BC] = number_format($this->triangleParameters[TriangleController::SIDE_BC], 3);
        ;

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

        $this->triangleParameters[TriangleController::HEIGHT_BH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AC]), 3);
        $this->triangleParameters[TriangleController::HEIGHT_CH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_BC], $this->triangleParameters[TriangleController::SIDE_AB]), 3);
        $this->triangleParameters[TriangleController::HEIGHT_AH] = number_format($this->heightFromSides($this->triangleParameters[TriangleController::SIDE_AC], $this->triangleParameters[TriangleController::SIDE_AB], $this->triangleParameters[TriangleController::SIDE_BC]), 3);
    }

    public function sendCookies()
    {
        setcookie('AB', $this->triangleParameters[TriangleController::SIDE_AB], time()+3600);
        setcookie('AC', $this->triangleParameters[TriangleController::SIDE_AC], time()+3600);
        setcookie('BC', $this->triangleParameters[TriangleController::SIDE_BC], time()+3600);

        setcookie('A', $this->triangleParameters[TriangleController::ANGLE_A], time()+3600);
        setcookie('B', $this->triangleParameters[TriangleController::ANGLE_B], time()+3600);
        setcookie('C', $this->triangleParameters[TriangleController::ANGLE_C], time()+3600);

        setcookie('AM', $this->triangleParameters[TriangleController::MEDIAN_AM], time()+3600);
        setcookie('BM', $this->triangleParameters[TriangleController::MEDIAN_BM], time()+3600);
        setcookie('CM', $this->triangleParameters[TriangleController::MEDIAN_CM], time()+3600);

        setcookie('AL', $this->triangleParameters[TriangleController::BISECTOR_AL], time()+3600);
        setcookie('BL', $this->triangleParameters[TriangleController::BISECTOR_BL], time()+3600);
        setcookie('CL', $this->triangleParameters[TriangleController::BISECTOR_CL], time()+3600);

        setcookie('AH', $this->triangleParameters[TriangleController::HEIGHT_AH], time()+3600);
        setcookie('BH', $this->triangleParameters[TriangleController::HEIGHT_BH], time()+3600);
        setcookie('CH', $this->triangleParameters[TriangleController::HEIGHT_CH], time()+3600);

        setcookie('IR', $this->triangleParameters[TriangleController::INNER_RADIUS], time()+3600);
        setcookie('OR', $this->triangleParameters[TriangleController::OUTER_RADIUS], time()+3600);

        setcookie('P', $this->triangleParameters[TriangleController::PERIMETER], time()+3600);
        setcookie('S', $this->triangleParameters[TriangleController::SURFACE], time()+3600);

        $Ck = $this->triangleParameters[TriangleController::SIDE_AB];
        $Bk = $this->triangleParameters[TriangleController::SIDE_AC];
        $Ak = $this->triangleParameters[TriangleController::SIDE_BC];
        $Hk = $this->triangleParameters[TriangleController::HEIGHT_CH];
        $this->setRightAfterInit();
        $right = (int)$this->isRight;

        for ($i = 1; $i < 51; $i++) {
            if ($Ak >= 11 || $Bk >= 11 || $Ck >= 11) {
                $Ak = $Ak / 2;
                $Bk = $Bk / 2;
                $Ck = $Ck / 2;
                $Hk = $Hk / 2;
            } elseif ($Ak <= 5.5 && $Bk <= 5.5 && $Ck <= 5.5) {
                $Ak = $Ak * 1.25;
                $Bk = $Bk * 1.25;
                $Ck = $Ck * 1.25;
                $Hk = $Hk * 1.25;
            } else {
                break;
            }
        }

        $this->evenOut();

        setcookie('Right', $right, time()+3600);
        setcookie('Ak', $Ak, time()+3600);
        setcookie('Ck', $Ck, time()+3600);
        setcookie('Bk', $Bk, time()+3600);
        setcookie('Hk', $Hk, time()+3600);
        setcookie('Parameters', json_encode($this->triangleParameters), time()+3600);
        setcookie('Given', json_encode($this->givenValues), time()+3600);
    }

    public function iterate(): string
    {
        if ($this->triangleParameters[3]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->cosTheoremForSideOppositeOfAngle(
                    $this->triangleParameters[3],
                    $this->triangleParameters[2],
                    $this->triangleParameters[0]
                );
            return "Cosine theorem using angle A and sides AB, AC to find the side BC.";
        }
        if ($this->triangleParameters[4]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->cosTheoremForSideOppositeOfAngle(
                    $this->triangleParameters[4],
                    $this->triangleParameters[1],
                    $this->triangleParameters[0]
                );
            return "Cosine theorem using angle B and sides AB, BC to find the side AC.";
        }
        if ($this->triangleParameters[5]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->cosTheoremForSideOppositeOfAngle(
                    $this->triangleParameters[5],
                    $this->triangleParameters[2],
                    $this->triangleParameters[1]
                );
            return "Cosine theorem using angle C and sides BC, AC to find the side AB.";
        }

        if ($this->triangleParameters[3]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[3],
                    $this->triangleParameters[1],
                    $this->triangleParameters[0]
                );
            return "Cosine theorem using angle A and sides AB, AC to find the side BC.";
        }
        if ($this->triangleParameters[3]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[3],
                    $this->triangleParameters[1],
                    $this->triangleParameters[2]
                );
            return "Cosine theorem using angle A and sides BC, AC to find the side AB.";
        }
        if ($this->triangleParameters[4]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[4],
                    $this->triangleParameters[2],
                    $this->triangleParameters[0]
                );
            return "Cosine theorem using angle B and sides AB, AC to find the side BC.";
        }
        if ($this->triangleParameters[4]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[4],
                    $this->triangleParameters[2],
                    $this->triangleParameters[1]
                );
            return "Cosine theorem using angle B and sides BC, AC to find the side AB.";
        }
        if ($this->triangleParameters[5]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[5],
                    $this->triangleParameters[0],
                    $this->triangleParameters[1]
                );
            return "Cosine theorem using angle C and sides AB, BC to find the side AC.";
        }
        if ($this->triangleParameters[5]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1] =
                $this->cosTheoremForSideOpposite(
                    $this->triangleParameters[5],
                    $this->triangleParameters[0],
                    $this->triangleParameters[2]
                );
            return "Cosine theorem using angle C and sides AB, AC to find the side BC.";
        }

        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[3]=="") {
            $this->triangleParameters[3]=
                $this->sinTheoremForAngle(
                    $this->triangleParameters[0],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle A, side AB, and the outer radius to find the angle A.";
        }
        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[4]=="") {
            $this->triangleParameters[4]=
                $this->sinTheoremForAngle(
                    $this->triangleParameters[1],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle B, side BC, and the outer radius to find the angle B.";
        }
        if ($this->triangleParameters[2]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[5]=="") {
            $this->triangleParameters[5]=
                $this->sinTheoremForAngle(
                    $this->triangleParameters[2],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle C, side BC, and the outer radius to find the angle C.";
        }

        if ($this->triangleParameters[3]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sinTheoremForSide(
                    $this->triangleParameters[3],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle A,  and the outer radius to find the side AB.";
        }
        if ($this->triangleParameters[4]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sinTheoremForSide(
                    $this->triangleParameters[4],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle B,  and the outer radius to find the side BC.";
        }
        if ($this->triangleParameters[5]!=""
            && $this->triangleParameters[9]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sinTheoremForSide(
                    $this->triangleParameters[5],
                    $this->triangleParameters[9]
                );
            return "Sine theorem using angle C,  and the outer radius to find the side BC.";
        }

        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[3]!=""
            && $this->triangleParameters[9]=="") {
            $this->triangleParameters[9]=
                $this->sinTheoremForR(
                    $this->triangleParameters[0],
                    $this->triangleParameters[3]
                );
            return "Sine theorem using angle A,  and the side AB to find the outer radius";
        }
        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[4]!=""
            && $this->triangleParameters[9]=="") {
            $this->triangleParameters[9]=
                $this->sinTheoremForR(
                    $this->triangleParameters[1],
                    $this->triangleParameters[4]
                );
            return "Sine theorem using angle B,  and the side BC to find the outer radius";
        }
        if ($this->triangleParameters[2]!=""
            && $this->triangleParameters[5]!=""
            && $this->triangleParameters[9]=="") {
            $this->triangleParameters[9]=
                $this->sinTheoremForR(
                    $this->triangleParameters[2],
                    $this->triangleParameters[5]
                );
            return "Sine theorem using angle C,  and the side AC to find the outer radius";
        }

        if ($this->triangleParameters[10]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromMedianOpposite(
                    $this->triangleParameters[10],
                    $this->triangleParameters[2],
                    $this->triangleParameters[0]
                );
            return "Median theorem using sides AB, AC and median AM to find the side BC";
        }
        if ($this->triangleParameters[11]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromMedianOpposite(
                    $this->triangleParameters[11],
                    $this->triangleParameters[1],
                    $this->triangleParameters[0]
                );
            return "Median theorem using sides AB, BC and median BM to find the side AC";
        }
        if ($this->triangleParameters[12]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromMedianOpposite(
                    $this->triangleParameters[12],
                    $this->triangleParameters[2],
                    $this->triangleParameters[0]
                );
            return "Median theorem using sides AC, BC and median CM to find the side AB";
        }

        if ($this->triangleParameters[10]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[0],
                    $this->triangleParameters[1],
                    $this->triangleParameters[10]
                );
            return "Median theorem using the sides AB, BC and median AM to find the side AC";
        }
        if ($this->triangleParameters[10]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[1],
                    $this->triangleParameters[2],
                    $this->triangleParameters[10]
                );
            return "Median theorem using the sides AC, BC and median AM to find the side AB";
        }
        if ($this->triangleParameters[11]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[2],
                    $this->triangleParameters[0],
                    $this->triangleParameters[11]
                );
            return "Median theorem using the sides AB, AC and median BM to find the side BC";
        }
        if ($this->triangleParameters[11]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[2],
                    $this->triangleParameters[1],
                    $this->triangleParameters[11]
                );
            return "Median theorem using the sides AC, BC and median BM to find the side AB";
        }
        if ($this->triangleParameters[12]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[0],
                    $this->triangleParameters[1],
                    $this->triangleParameters[12]
                );
            return "Median theorem using the sides AB, BC and median CM to find the side AC";
        }
        if ($this->triangleParameters[12]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromMedianNonOpposite(
                    $this->triangleParameters[0],
                    $this->triangleParameters[2],
                    $this->triangleParameters[12]
                );
            return "Median theorem using the sides AB, AC and median CM to find the side BC";
        }

        if ($this->triangleParameters[20]!=""
            && $this->triangleParameters[21]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[13]=="") {
            $this->triangleParameters[13]=
                $this->bisectorFromSides(
                    $this->triangleParameters[20],
                    $this->triangleParameters[21],
                    $this->triangleParameters[1],
                    $this->triangleParameters[2]
                );
            return "Bisector theorem using the sides BA1, AC1, AC, BC to find the bisector AA1";
        }
        if ($this->triangleParameters[16]!=""
            && $this->triangleParameters[17]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[14]=="") {
            $this->triangleParameters[14]=
                $this->bisectorFromSides(
                    $this->triangleParameters[16],
                    $this->triangleParameters[17],
                    $this->triangleParameters[0],
                    $this->triangleParameters[2]
                );
            return "Bisector theorem using the sides AB1, CB1, AB, BC to find the bisector BB1";
        }
        if ($this->triangleParameters[18]!=""
            && $this->triangleParameters[19]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[15]=="") {
            $this->triangleParameters[15]=
                $this->bisectorFromSides(
                    $this->triangleParameters[18],
                    $this->triangleParameters[19],
                    $this->triangleParameters[1],
                    $this->triangleParameters[0]
                );
            return "Bisector theorem using the sides CA1, CB1, AB, BC to find the bisector CC1";
        }

        if ($this->triangleParameters[20]!=""
            && $this->triangleParameters[21]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[19],
                    $this->triangleParameters[20],
                    $this->triangleParameters[1]
                );
            return "Bisector theorem using the sides AB1, AC1, BC to find the side AB.";
        }
        if ($this->triangleParameters[20]!=""
            && $this->triangleParameters[21]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[19],
                    $this->triangleParameters[20],
                    $this->triangleParameters[0]
                );
            return "Bisector theorem using the sides AB1, AC1, AB to find the side BC.";
        }
        if ($this->triangleParameters[16]!=""
            && $this->triangleParameters[17]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[16],
                    $this->triangleParameters[17],
                    $this->triangleParameters[1]
                );
            return "Bisector theorem using the sides BA1, BC1, BC to find the side AB.";
        }
        if ($this->triangleParameters[16]!=""
            && $this->triangleParameters[17]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[16],
                    $this->triangleParameters[17],
                    $this->triangleParameters[2]
                );
            return "Bisector theorem using the sides BA1, BC1, AC to find the side BC.";
        }
        if ($this->triangleParameters[18]!=""
            && $this->triangleParameters[19]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[18],
                    $this->triangleParameters[19],
                    $this->triangleParameters[2]
                );
            return "Bisector theorem using the sides CA1, CB1, AC to find the side AB.";
        }
        if ($this->triangleParameters[18]!=""
            && $this->triangleParameters[19]!=""
            && $this->triangleParameters[0]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromBisectorFragments(
                    $this->triangleParameters[18],
                    $this->triangleParameters[19],
                    $this->triangleParameters[0]
                );
            return "Bisector theorem using the sides CA1, CB1, AB to find the side BC.";
        }

        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[4]!=""
            && $this->triangleParameters[14]=="") {
            $this->triangleParameters[14]=
                $this->bisectorFromSidesAndAngleCos(
                    $this->triangleParameters[1],
                    $this->triangleParameters[0],
                    $this->triangleParameters[4]
                );
            return "Bisector theorem using the sides AB, AC and angle B to find the bisector BL.";
        }
        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[3]!=""
            && $this->triangleParameters[13]=="") {
            $this->triangleParameters[13]=
                $this->bisectorFromSidesAndAngleCos(
                    $this->triangleParameters[2],
                    $this->triangleParameters[0],
                    $this->triangleParameters[3]
                );
            return "Bisector theorem using the sides AB, BC and angle A to find the bisector AL.";
        }
        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[5]!=""
            && $this->triangleParameters[15]=="") {
            $this->triangleParameters[15]=
                $this->bisectorFromSidesAndAngleCos(
                    $this->triangleParameters[2],
                    $this->triangleParameters[1],
                    $this->triangleParameters[5]
                );
            return "Bisector theorem using the sides AC, BC and angle C to find the bisector CL.";
        }

        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[1]!=""
            && $this->triangleParameters[14]!=""
            && $this->triangleParameters[4]=="") {
            $this->triangleParameters[4]=
                $this->angleFromBisectorAndSide(
                    $this->triangleParameters[0],
                    $this->triangleParameters[1],
                    $this->triangleParameters[14]
                );
            return "Bisector theorem using the sides AB, BC the bisector BL to find the angle B.";
        }
        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[13]!=""
            && $this->triangleParameters[3]=="") {
            $this->triangleParameters[3]=
                $this->angleFromBisectorAndSide(
                    $this->triangleParameters[2],
                    $this->triangleParameters[0],
                    $this->triangleParameters[13]
                );
            return "Bisector theorem using the sides AB, AC the bisector AL to find the angle A.";
        }
        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[2]!=""
            && $this->triangleParameters[15]!=""
            && $this->triangleParameters[5]=="") {
            $this->triangleParameters[5]=
                $this->angleFromBisectorAndSide(
                    $this->triangleParameters[2],
                    $this->triangleParameters[1],
                    $this->triangleParameters[15]
                );
            return "Bisector theorem using the sides AC, BC the bisector CL to find the angle C.";
        }

        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[24]!=""
            && $this->triangleParameters[7]=="") {
            $this->triangleParameters[7]=
                $this->surfaceFromSideAndHeight(
                    $this->triangleParameters[0],
                    $this->triangleParameters[24]
                );
            return "Using the side AB, height CH we can find the surface.";
        }
        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[22]!=""
            && $this->triangleParameters[7]=="") {
            $this->triangleParameters[7]=
                $this->surfaceFromSideAndHeight(
                    $this->triangleParameters[1],
                    $this->triangleParameters[22]
                );
            return "Using the side CB, height AH we can find the surface.";
        }
        if ($this->triangleParameters[2]!=""
            && $this->triangleParameters[23]!=""
            && $this->triangleParameters[7]=="") {
            $this->triangleParameters[7]=
                $this->surfaceFromSideAndHeight(
                    $this->triangleParameters[2],
                    $this->triangleParameters[23]
                );
            return "Using the side AC, height BH we can find the surface.";
        }

        if ($this->triangleParameters[10]!=""
            && $this->triangleParameters[13]!=""
            && $this->triangleParameters[22]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromBisectorHeightMedian(
                    $this->triangleParameters[13],
                    $this->triangleParameters[10],
                    $this->triangleParameters[22]
                );
            return "Using the median AM, height AH, bisector AL we can find the side BC.";
        }
        if ($this->triangleParameters[11]!=""
            && $this->triangleParameters[14]!=""
            && $this->triangleParameters[23]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromBisectorHeightMedian(
                    $this->triangleParameters[14],
                    $this->triangleParameters[11],
                    $this->triangleParameters[23]
                );
            return "Using the median BM, height BH, bisector BL we can find the side AC.";
        }
        if ($this->triangleParameters[12]!=""
            && $this->triangleParameters[15]!=""
            && $this->triangleParameters[24]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromBisectorHeightMedian(
                    $this->triangleParameters[15],
                    $this->triangleParameters[12],
                    $this->triangleParameters[24]
                );
            return "Using the median CM, height CH, bisector CL we can find the side AB.";
        }

        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[13]!=""
            && $this->triangleParameters[22]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->side2FromMedianHeightAndSide(
                    $this->triangleParameters[13],
                    $this->triangleParameters[22],
                    $this->triangleParameters[1]
                );
            return "Using the side BC, height AH, bisector AL we can find the side AC.";
        }
        if ($this->triangleParameters[2]!=""
            && $this->triangleParameters[14]!=""
            && $this->triangleParameters[23]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->side2FromMedianHeightAndSide(
                    $this->triangleParameters[14],
                    $this->triangleParameters[23],
                    $this->triangleParameters[2]
                );
            return "Using the side AC, height BH, bisector BL we can find the side AB.";
        }
        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[15]!=""
            && $this->triangleParameters[24]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->side2FromMedianHeightAndSide(
                    $this->triangleParameters[15],
                    $this->triangleParameters[24],
                    $this->triangleParameters[0]
                );
            return "Using the side AB, height CH, bisector CL we can find the side BC.";
        }

        if ($this->triangleParameters[1]!=""
            && $this->triangleParameters[13]!=""
            && $this->triangleParameters[22]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->side3FromMedianHeightAndSide(
                    $this->triangleParameters[13],
                    $this->triangleParameters[22],
                    $this->triangleParameters[1]
                );
            return "Using the side BC, height AH, bisector AL we can find the side AB.";
        }
        if ($this->triangleParameters[2]!=""
            && $this->triangleParameters[14]!=""
            && $this->triangleParameters[23]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->side3FromMedianHeightAndSide(
                    $this->triangleParameters[14],
                    $this->triangleParameters[23],
                    $this->triangleParameters[2]
                );
            return "Using the side AC, height BH, bisector BL we can find the side BC.";
        }
        if ($this->triangleParameters[0]!=""
            && $this->triangleParameters[15]!=""
            && $this->triangleParameters[24]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->side3FromMedianHeightAndSide(
                    $this->triangleParameters[15],
                    $this->triangleParameters[24],
                    $this->triangleParameters[0]
                );
            return "Using the side AB, height CH, bisector CL we can find the side AC.";
        }

        if ($this->triangleParameters[9]!=""
            && $this->triangleParameters[24]!=""
            && $this->triangleParameters[8]!=""
            && $this->triangleParameters[2]=="") {
            $this->triangleParameters[2]=
                $this->sideFromOppositeHeightSmallRadiusLargeRadius(
                    $this->triangleParameters[24],
                    $this->triangleParameters[8],
                    $this->triangleParameters[9]
                );
            return "Using the height CH, R and r we can find the side AC.";
        }
        if ($this->triangleParameters[9]!=""
            && $this->triangleParameters[23]!=""
            && $this->triangleParameters[8]!=""
            && $this->triangleParameters[1]=="") {
            $this->triangleParameters[1]=
                $this->sideFromOppositeHeightSmallRadiusLargeRadius(
                    $this->triangleParameters[23],
                    $this->triangleParameters[8],
                    $this->triangleParameters[9]
                );
            return "Using the height BH, R and r we can find the side BC.";
        }
        if ($this->triangleParameters[9]!=""
            && $this->triangleParameters[22]!=""
            && $this->triangleParameters[8]!=""
            && $this->triangleParameters[0]=="") {
            $this->triangleParameters[0]=
                $this->sideFromOppositeHeightSmallRadiusLargeRadius(
                    $this->triangleParameters[22],
                    $this->triangleParameters[8],
                    $this->triangleParameters[9]
                );
            return "Using the height AH, R and r we can find the side AB.";
        }
        return "";
    }

    public function fullSet()
    {
        return array_search("", $this->triangleParameters, true);
    }
}
