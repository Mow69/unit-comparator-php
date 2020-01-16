<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * UserStory 1 : m² to hectare
     */
    public function index(Request $request)
    {
        $get = $request->query->get('squaremeter');
        return new Response($get/10000);
    }
}
