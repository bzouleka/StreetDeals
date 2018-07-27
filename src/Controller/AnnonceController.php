<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AnnonceType;
use App\Service\FileUploader;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

class AnnonceController extends Controller
{
    /**
     * @Route("/annonce", name="annonce")
     *  Method({"POST"})
     */

    public function new(Request $request, FileUploader $fileUploader, UserInterface $user)
    {
        $annonce = new Product();

        $form = $this->createForm(AnnonceType::class, $annonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setUser($user);
            $file = $form->get("photo")->getData();
//            $file = $annonce->getPhoto();
            $fileName = $fileUploader->upload($file);
            $annonce->setPhoto($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('main');
        }


        return $this->render('annonce/index.html.twig', array(
            'form' => $form->createView() )
        );
    }

    public function delete(AnnonceType $annonce)
    {
        $em = $this->getDoctrine ()->getManager ();
        $em->remove ($annonce);
        $em->flush ();
        return $this->redirectToRoute ("main");
    }


}

