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
        if (($aConvertir = $request->request->get('aConvertir')) && ($typeConvertion = $request->request->get('typeConvertion'))){
            switch ($typeConvertion) {
                case "squareMeterToHectare" :
                    if ($aConvertir >= 0) {
                        return new JsonResponse($aConvertir / 10000);
                    } else {
                        return new JsonResponse("Erreur : Valeur invalide");
                    }
                    break;
                case "kwToKgCo2" :
                    if ($aConvertir >= 0) {
                        return new JsonResponse($aConvertir * 0.09);
                    } else {
                        return new JsonResponse("Erreur : Valeur invalide");
                    }
                    break;
                default:
                    return new JsonResponse("Parametre(s) requete http incorrect(s)");
            }
        } else {
            return new JsonResponse("Parametre(s) requete http incorrect(s)");
        }
    }
}