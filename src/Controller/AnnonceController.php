<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AnnonceType;
use App\Service\FileUploader;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

//
//        $form = $this->createForm(AnnonceType::class, $annonce);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($annonce);
//            $em->flush();
//            return $this->redirectToRoute('annonce');
//        }
//        return $this->render('annonce/index.html.twig', [
//            'form' => $form->createView()
//        ]);

        $form = $this->createFormBuilder($annonce)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('photo', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')))

            ->getForm();

        return $this->render('annonce/index.html.twig', array(
            'form' => $form->createView(),
            ));




        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $product->getBrochure();
            $fileName = $fileUploader->upload($file);

            $product->setBrochure($fileName);

            return $this->redirectToRoute('annonce');



        }

        // ...
    }



}

