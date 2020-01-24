<?php

namespace App\Service;

use App\Repository\UnitRepository;

class UnitService
{

    public function displayUnits(UnitRepository $unitRepository)
    {
        $uniteList = $unitRepository->findAll();
        return $uniteList;
    }
}