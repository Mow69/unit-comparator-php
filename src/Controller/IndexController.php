<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index", methods={"POST"})
     * UserStory 1 : m² to hectare
     */
    public function m2ToHectare()
    {
        $aConvertir = $_POST['squaremeter'] ;
        if (isset($aConvertir)){
            return new Response($aConvertir/10000);
        }
    }
}
