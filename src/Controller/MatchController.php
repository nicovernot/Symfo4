<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;

class MatchController extends AbstractController
{
    /**
     * @Route("/match", name="match")
     */
    public function index(MatchRepository $matchrepo)
    {
        return $this->render('match/index.html.twig', [
            'controller_name' => 'MatchController',
            'list' => $matchrepo->findByParticipant(65),
        ]);
    }
}
