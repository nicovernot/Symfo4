<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class LogOnController extends AbstractController
{
    private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }

    /**
     * @Route("/logon", name="log_on")
     */
    public function index(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $password = $form["password"]->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setPassword($this->passwordEncoder->encodePassword(
            $user,$password));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('session_index');
        }
        return $this->render('log_on/index.html.twig', [
            'controller_name' => 'LogOnController',
           // 'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
