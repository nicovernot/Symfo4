<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use App\Repository\SessionRepository;
use App\Repository\ParcipantRepository;
use Symfony\Component\HttpFoundation\Request;

class MatchController extends AbstractController
{
    /**
     * @Route("/match", name="match")
     */
    public function index(MatchRepository $matchrepo,Request $request)
    {

        $user = $request->query->get('user');
       
        return $this->render('match/index.html.twig', [
            'controller_name' => 'MatchController',
            'list' => $matchrepo->findByParticipant($user),
            'mesjeux'=>$matchrepo->findByGameParticipant($user),
            'user'=>$this->getUser(),
        ]);
    }

     /**
     * @Route("/match/participer", name="matchParticiper")
     */
    public function participer(Request $request)
    {
        $session = $request->query->get('session');
        $user = $request->query->get('user');
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        return $this->redirectToRoute('match', [], 301);
    }

     /**
     * @Route("/match/mesparties", name="matchmespartis")
     */
    public function mesparties(MatchRepository $matchrepo)
    {
        return $this->render('match/mesparties.html.twig', [
            'controller_name' => 'MatchController',
            'list' => $matchrepo->findByParticipant(283),
            'mesjeux'=>$matchrepo->findByGameParticipant(283),
            'user'=>$this->getUser(),
        ]);
    }


}
