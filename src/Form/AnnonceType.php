<?php

namespace App\Form;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\FileUploader;
use Doctrine\ORM\Cache\Region;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class)
            ->add('Description', TextareaType::class)
            ->add('CreateAt', DateTimeType::class, array('label' => "Date de mise en ligne"))
            ->add('photo', FileType::class, array('data_class' => null, 'label' => 'Photo de votre annonce'))
            ->add('region')
            ->add('category', ChoiceType:: class, array('choices' => array(
                'Catégorie' => null,
                'Memes' => 'Memes',
                'Voyages' => 'voyages',
                'Ventes' => 'ventes',
                'Service' => 'service'
    )))
            ->add('other')
            ->add('product')
            ->add('save', SubmitType::class, array('label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }


}
