<?php

namespace App\Controller;


use App\ClassFilterUnits;
use App\JSONToReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function App\Service\co2ToKw;
use function App\Service\kwToCo2;
use function App\Service\m2toHectare;


class IndexController extends AbstractController
{
    const ERROR_CODE = 400;

    /**
     * @Route("/convert", name="convert", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @param Request $request
     * @return JsonResponse
     */
    public function convert(Request $request)
    {
        $myObject = new JSONToReturn("Unknown error");
        if ($content = $request->getContent()) {
            $decode = json_decode($content, true);
            if (isset($decode['inUnit']) && isset($decode['outUnit'])) {

                if ($decode['inUnit'] == 'm2' && $decode['outUnit'] == 'hectare') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = m2toHectare($decode['valueToConvert']);
                    }
                }

                if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = kwToCo2($decode['valueToConvert']);
                    }
                }
                if ($decode ['inUnit'] == 'kgCo2' && $decode['outUnit'] == 'kW') {
                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = co2ToKw($decode['valueToConvert']);
                    }

                }
                if ($decode ['inUnit'] == 'hectare' && $decode['outUnit'] == 'm2') {
                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = m2toHectare($decode['valueToConvert']);
                    }
                }
        } else {
            $myObject->result = ["message" => " sent inUnit or/and outUnit not found"];
            return new JsonResponse($myObject, self::ERROR_CODE);
        }
        if (isset($toReturn)) {
            $myObject->result = ['convertedValue' => $toReturn];
            return new JsonResponse($myObject);
        }

        return new JsonResponse($myObject, self::ERROR_CODE);
    }
}

/**
 * @Route("/filterunits", name="filterunits", methods={"POST"})
 * UserStory 1 : m² to hectare
 * @return JsonResponse
 */
public
function filterunits()
{
    $myObject = new JSONToReturn([
        ['inUnit' => 'm2', 'outUnit' => 'hectare'],
        ['inUnit' => 'kW', 'outUnit' => 'kgCo2'],
        ['inUnit' => 'hectare', 'outUnit' => 'm2'],
        ['inUnit' => 'kgCo2', 'outUnit' => 'kW']
    ]);

    return new JsonResponse($myObject);
}
}








