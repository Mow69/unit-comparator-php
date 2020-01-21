<?php

namespace App\Service;

function m2toHectare($value)
{
    return $value / 10000;
}

function kwToCo2($value)
{
    return $value * 0.09;
}

function HectareToM2($value)
{
    return $value * 10000;
}

function co2ToKw($value)
{
    return $value / 0.09;
}