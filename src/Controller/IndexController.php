<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/convert", name="index", methods={"POST"})
     * UserStory 1 : m² to hectare
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        try {
            $content = $request->getContent();

            if ($content) {
                $decode = json_decode($content, true);
                if ($decode['valueToConvert'] && gmp_sign($decode['valueToConvert']) === 1) {
                    $toReturn = $decode ['valueToConvert'] / 10000;
                    return new JsonResponse(array('result' => $toReturn));

                } else if(!$decode['valueToConvert']){
                    return new JsonResponse("valueToConvert is not defined.");

                } else if(gmp_sign($decode['valueToConvert']) === -1){
                    return new JsonResponse("Impossible to convert a negative number.");
                }
            }

            return new JsonResponse("Error with the request. $content = ". $content);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}