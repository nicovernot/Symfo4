<?php

namespace App\Controller;

use App\Entity\Regle;
use App\Form\RegleType;
use App\Repository\RegleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @IsGranted("ROLE_ADMIN")
 *
 *
 * @Route("/regle")
 */
class RegleController extends AbstractController
{
    /**
     * @Route("/", name="regle_index", methods={"GET"})
     */
    public function index(RegleRepository $regleRepository): Response
    {
        return $this->render('regle/index.html.twig', [
            'regles' => $regleRepository->findAll(),
            'user'=>$this->getUser(),
        ]);
    }

    /**
     * @Route("/new", name="regle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $regle = new Regle();
        $form = $this->createForm(RegleType::class, $regle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($regle);
            $entityManager->flush();

            return $this->redirectToRoute('regle_index');
        }

        return $this->render('regle/new.html.twig', [
            'regle' => $regle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="regle_show", methods={"GET"})
     */
    public function show(Regle $regle): Response
    {
        return $this->render('regle/show.html.twig', [
            'regle' => $regle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="regle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Regle $regle): Response
    {
        $form = $this->createForm(RegleType::class, $regle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('regle_index', [
                'id' => $regle->getId(),
            ]);
        }

        return $this->render('regle/edit.html.twig', [
            'regle' => $regle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="regle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Regle $regle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$regle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('regle_index');
    }
}
