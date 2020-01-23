<?php

namespace App\Controller;


use App\ClassFilterUnits;
use App\JSONToReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function App\Service\co2ToKw;
use function App\Service\hectareToM2;
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

                if ($decode['inUnit'] == 'm2' && $decode['outUnit'] == 'ha') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = m2toHectare($decode['valueToConvert']);
                    }
                }

                if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kg CO2') {

                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = kwToCo2($decode['valueToConvert']);
                    }
                }
                if ($decode ['inUnit'] == 'kg CO2' && $decode['outUnit'] == 'kW') {
                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = co2ToKw($decode['valueToConvert']);
                    }

                }
                if ($decode ['inUnit'] == 'ha' && $decode['outUnit'] == 'm2') {
                    if (!isset($decode ['valueToConvert']) ||
                        !is_numeric($decode ['valueToConvert']) ||
                        $decode['valueToConvert'] < 0) {
                        $myObject->result = ["message" => "valueToConvert incorrect"];
                        return new JsonResponse($myObject, self::ERROR_CODE);
                    } else {
                        $toReturn = hectareToM2($decode['valueToConvert']);
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
     * @Route("/filterunits", name="filterunits", methods={"GET"})
     * UserStory 1 : m² to hectare
     * @return JsonResponse
     */
    public
    function filterunits()
    {
        $myObject = new JSONToReturn([
            ['inUnit' => 'm2', 'outUnit' => 'ha'],
            ['inUnit' => 'ha', 'outUnit' => 'm2'],
            ['inUnit' => 'kW', 'outUnit' => 'kg CO2'],
            ['inUnit' => 'kg CO2', 'outUnit' => 'kW']
        ]);

        return new JsonResponse($myObject);
    }

    /**
     * @Route("/unit", name="unit", methods={"GET"})
     * UserStory 1 : m² to hectare
     * @return void
     */
    public
    function unit()
    {
        $fausseExtraction =[
            ['unit' => 'm2', 'definition' => 'Un carré de 1m x 1m','source'=>'https://fr.wikipedia.org/wiki/M%C3%A8tre_carr%C3%A9'],
            ['unit' => 'ha', 'definition' => 'Un carré de 100m x 100m','source'=>'https://fr.wikipedia.org/wiki/Hectare'],
            ['unit' => 'kW', 'definition' => 'Unité de puissance, multiple du watt, et valant 1000 watts','source'=>'https://www.actu-environnement.com/ae/dictionnaire_environnement/definition/kilowatt_kw.php4'],
            ['unit' => 'kg CO2', 'definition' => 'Quantité de gaz à effet de serre','source'=>'https://fr.wikipedia.org/wiki/%C3%89quivalent_CO2'],
        ];

        $myObject = new JSONToReturn($fausseExtraction);
        return new JsonResponse($myObject);
    }

}








