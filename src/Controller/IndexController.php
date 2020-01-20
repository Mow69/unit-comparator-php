<?php

namespace App\Controller;


use App\ClassFilterUnits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use JMS\Serializer\Serializer;

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
     * @return JsonResponse
     */
    public function filterunits(){
        $myObject = new ClassFilterUnits();
        return new JsonResponse($myObject);
    }
}




//    }
//{        return new JsonResponse(
//$serializer->serialize(
//[
//'result' => $toReturn
//],
//'json'
//),
//Response::HTTP_OK
//);
//
//}






