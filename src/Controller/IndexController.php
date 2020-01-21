<?php

namespace App\Controller;


use App\ClassFilterUnits;
use App\JSONToReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function App\Service\ifNotExist;

class IndexController extends AbstractController
{
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
                        return new JsonResponse($myObject, 400);
                    } else {
                        $toReturn = $decode ['valueToConvert'] / 10000;
                    }
                }

                if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, 400);
                    } else {
                        $toReturn = $decode ['valueToConvert'] * 0.09;
                    }
                }
            } else {
                $myObject->result = ["message" => " sent inUnit or/and outUnit not found"];
                return new JsonResponse($myObject, 400);
            }
            if (isset($toReturn)) {
                $myObject->result = ['convertedValue' => $toReturn];
                return new JsonResponse($myObject);
            }

            return new JsonResponse($myObject, 400);
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
        $myObject = new JSONToReturn([['inUnit' => 'm2', 'outUnit' => 'hectare'], ['inUnit' => 'kW', 'outUnit' => 'kgCo2']]);
        return new JsonResponse($myObject);
    }
}








