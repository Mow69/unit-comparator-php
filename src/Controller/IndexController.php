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
     */
    public function index(Request $request)
    {
        $aConvertir = $_POST['squaremeter'] ;
        if (isset($aConvertir)){
            if ($aConvertir >= 0) {
                return new JsonResponse($aConvertir / 10000);
            } else {
                return new JsonResponse("Valeur invalide");
            }
        }
    }
}
