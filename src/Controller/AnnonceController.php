<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AnnonceType;
use App\Service\FileUploader;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{
    /**
     * @Route("/annonce", name="annonce")
     *  Method({"GET", "POST"})
     */

    public function new(Request $request, FileUploader $fileUploader)
    {
        $annonce = new Product();

        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('annonce');
        }


        return $this->render('annonce/index.html.twig', array(
            'form' => $form->createView() )
        );
    }
}

