<?php

    namespace App\Controller;

    use App\Entity\User;
    use App\Form\RegisterFormType;
    use App\Service\Email;
    use Doctrine\Common\Persistence\ObjectManager;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    use Symfony\Component\Security\Core\Security;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


    class SecurityController extends Controller
    {
//

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
        public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, Email $email)
        {

            $user = new User();

            $form = $this->createForm(RegisterFormType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $hash = $encoder->encodePassword($user, $user->getPassword());

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();

                $email->sendEmail("inscription", "saien.formation@gmail.com", "bzouleka@gmail.com","bienvenue");

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

        public function logout()
        {


        }
        public function hello($name)
        {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        }
        public function index()
        {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            $user = $this->getUser();
            return new Response('bonjour '.$user->getFirstName());
        }

        public function indexAction(Security $security)
        {
            $user = $security->getUser();
        }

    }
