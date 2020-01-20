<?php

namespace App\Controller;


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
                $toReturn = $decode ['valueToConvert'] / 10000;
                $toReturn = array('result' => $toReturn);
                return new JsonResponse($toReturn);
            }
            if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {
                $toReturn = $decode ['valueToConvert'] * 0.09;
                $toReturn = array('result' => $toReturn);
                return new JsonResponse($toReturn);
            }
        }
    }

    /**
     * @Route("/filterunits", name="filterunits", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @param Request $request
     * @return JsonResponse
     */
    public function filterunits(Request $request){
        $myConvertions = array(
            array('m2', 'hectare'),
            array('kW','kgCo2')
            );
        return new JsonResponse($myConvertions);
    }
}


