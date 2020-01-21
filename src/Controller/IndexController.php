<?php

namespace App\Controller;


use App\ClassFilterUnits;
use App\JSONToReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        if ($content = $request->getContent()) {
            $decode = json_decode($content, true);
            if ($decode['inUnit'] == 'm2' && $decode['outUnit'] == 'hectare') {
                if (isset($decode ['valueToConvert'])) {
                    $toReturn = $decode ['valueToConvert'] / 10000;
                }
                else {
                    $myObject = new JSONToReturn(["message" => "Please enter a value to convert"]);
                    return new JsonResponse($myObject, 400);
                }
            }
            if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {
                if (isset($decode ['valueToConvert'])) {
                $toReturn = $decode ['valueToConvert'] * 0.09;
                }
                else {
                    $myObject = new JSONToReturn(["message" => "Please enter a value to convert"]);
                    return new JsonResponse($myObject, 400);
                }
            }
            if (isset($toReturn)) {
                $myObject = new JSONToReturn(['convertedValue' => $toReturn]);
                return new JsonResponse($myObject);
            }
            else {
                $myObject = new JSONToReturn(["message" => "Please enter a value to convert"]);
                return new JsonResponse($myObject, 400);
            }
        }
    }

    /**
     * @Route("/filterunits", name="filterunits", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @return JsonResponse
     */
    public function filterunits(){
        $myObject = new JSONToReturn([['inUnit'=>'m2', 'outUnit'=>'hectare'], ['inUnit'=>'kW', 'outUnit'=>'kgCo2']]);
        return new JsonResponse($myObject);
    }
}








