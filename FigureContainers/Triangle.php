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
    public $parameter;

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
     * @param $parameter
     * @param $innerRadius
     * @param $outerRadius
     * @param $medianAM
     * @param $medianBM
     * @param $medianCM
     * @param $bisectorAL
     * @param $bisectorBL
     * @param $bisectorCL
     * @param $heightAH
     * @param $heightBH
     * @param $heightCH
     */
    public function __construct($sideAB, $sideAC, $sideBC, $angleA, $angleB, $angleC, $surface, $parameter, $innerRadius, $outerRadius, $medianAM, $medianBM, $medianCM, $bisectorAL, $bisectorBL, $bisectorCL, $heightAH, $heightBH, $heightCH)
    {
        $this->sideAB = $sideAB;
        $this->sideAC = $sideAC;
        $this->sideBC = $sideBC;
        $this->angleA = $angleA;
        $this->angleB = $angleB;
        $this->angleC = $angleC;
        $this->surface = $surface;
        $this->parameter = $parameter;
        $this->innerRadius = $innerRadius;
        $this->outerRadius = $outerRadius;
        $this->medianAM = $medianAM;
        $this->medianBM = $medianBM;
        $this->medianCM = $medianCM;
        $this->bisectorAL = $bisectorAL;
        $this->bisectorBL = $bisectorBL;
        $this->bisectorCL = $bisectorCL;
        $this->heightAH = $heightAH;
        $this->heightBH = $heightBH;
        $this->heightCH = $heightCH;
    }


}