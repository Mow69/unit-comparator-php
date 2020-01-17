<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
            return new Response($aConvertir/10000);
        }
    }
}
