<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AnnonceType;
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
     * @Route("/main", name="annonce_show")
     */
    public function show(){

        $annonce = new Product();

        $form = $this->createForm(AnnonceType::class, $annonce);


        return $this->render('main/show.html.twig', [
            'annonce' => $annonce,
            'article' => $form->createView()
        ]);

    }
}
