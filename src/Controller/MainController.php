<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AnnonceType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    private $annonceAll;

    /**
     * @Route("/main", name="main")
     */

    public function index(EntityManagerInterface $em)
    {
        $annonceAll = $em->getRepository(Product::class)->findAll();



        return $this->render('main/index.html.twig', [
//            'controller_name' => 'MainController',
        'annonceAll' => $annonceAll
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

        $annonces = new Product();

        $form = $this->createForm(AnnonceType::class, $annonces);


        return $this->render('main/show.html.twig', [
            'annonce' => $annonces,
            'article' => $form->createView()
        ]);

    }
}
