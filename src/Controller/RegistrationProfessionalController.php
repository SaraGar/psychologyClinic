<?php

namespace App\Controller;

use App\Entity\Psychologist;
use App\Form\RegistrationFormTypeProfessional;
use App\Security\ProfessionalAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationProfessionalController extends AbstractController
{
    /**
     * @Route("/professional_register", name="professional_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, ProfessionalAuthenticator $authenticator): Response
    {
        $user = new Psychologist();
        $form = $this->createForm(RegistrationFormTypeProfessional::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'professional' // firewall name in security.yaml
            );
        }

        return $this->render('registration/registerProfessional.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
