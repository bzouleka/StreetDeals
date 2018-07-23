<?php

    namespace App\Controller;

    use App\Entity\User;
    use App\Form\RegisterFormType;
    use Doctrine\Common\Persistence\ObjectManager;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


    class SecurityController extends Controller
    {
//    /**
//     * @Route("/security", name="security")
//     */
//    public function index()
//    {
//        return $this->render('security/index.html.twig', [
//            'controller_name' => 'SecurityController',
//        ]);
//    }

        /**
         * @param Request $request
         * @param AuthenticationUtils $authenticationUtils
         * @return \Symfony\Component\HttpFoundation\Response
         * @Route("/login", name="login")
         */

        /**
         * @param Request $request
         * @param ObjectManager $manager
         * @param UserPasswordEncoderInterface $encoder
         * @return \Symfony\Component\HttpFoundation\Response
         * @Route("/inscription", name="security_registration")
         */
        public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
        {

            $user = new User();

            $form = $this->createForm(RegisterFormType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $hash = $encoder->encodePassword($user, $user->getPassword());

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();


            }

            return $this->render('security/registration.html.twig', ['form' => $form->createView()]);
        }


        /**
         * @param Request $request
         * @param AuthenticationUtils $authenticationUtils
         * @return \Symfony\Component\HttpFoundation\Response
         * @Route("/login", name="security_login")
         */
        public function login(Request $request, AuthenticationUtils $authenticationUtils)
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();


            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            dump($lastUsername);


            return $this->render('security/login.html.twig', array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));
        }

        /**
         * @Route("/logout", name="security_logout")
         */

        public function logout(){


        }

    }
