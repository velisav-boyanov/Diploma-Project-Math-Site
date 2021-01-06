<?php


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


}