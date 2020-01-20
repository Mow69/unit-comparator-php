<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($content = $request->getContent()) {
            $decode = json_decode($content, true);
            if ($decode['inUnit'] == 'm2' && $decode['outUnit'] == 'hectare') {
                $toReturn = $decode ['valueToConvert'] / 10000;
                return new JsonResponse($toReturn);
            }
            if ($decode ['inUnit'] == 'kW' && $decode['outUnit'] == 'kgCo2') {
                $toReturn = $decode ['valueToConvert'] * 0.09;
                return new JsonResponse($toReturn);
            }


        }


    }
}


