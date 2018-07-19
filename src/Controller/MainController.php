<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('main/home.html.twig');
    }

//    /**
//     * @Route("/main/compte", name="compte")
//     */
//    public function connect(){
//        return $this->render('main/compte.html.twig');
//    }

    /**
     * @Route("/main/2", name="annonce_show")
     */
    public function show(){
        return $this->render('main/show.html.twig');
    }
}
