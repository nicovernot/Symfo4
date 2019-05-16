<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use App\Repository\SessionRepository;
use App\Repository\ParcipantRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Participant;
use App\Entity\Regle;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class MatchController extends AbstractController
{
    /**
     * @Route("/match", name="match")
     */
    public function index(Request $request,Connection $connection)
    {
        $us=$request->query->get("user");
        $se = $connection->fetchAll("SELECT id FROM `session` WHERE id NOT IN (SELECT `session_id` FROM participant_session WHERE participant_id = ".$us.")");
        $list = array();
        foreach ($se as $key => $value) {
            $sess = $this->getDoctrine()
            ->getRepository(Session::class)
            ->find($value);
            $list[$key] = $sess;
        }

        $mj = $connection->fetchAll("SELECT id FROM `session` WHERE id IN (SELECT `session_id` FROM participant_session WHERE participant_id = ".$us.")");
        $mesjeux = array();
        foreach ($mj as $key => $value) {
            $mess = $this->getDoctrine()
            ->getRepository(Session::class)
            ->find($value);
            $mesjeux[$key] = $mess;
        }


        $user = $request->query->get('user');
       
        return $this->render('match/index.html.twig', [
            'controller_name' => 'MatchController',
            'list' =>$list,
            'mesjeux'=>$mesjeux,
            'user'=>$this->getUser(),
            'sess'=>$se,
        ]);
    }

     /**
     * @Route("/match/participer", name="matchParticiper")
     */
    public function participer(Request $request)
    {
        $session = $request->query->get('session');
        $user = $request->query->get('user');
        $entityManager = $this->getDoctrine()->getManager();
        $session = $request->query->get('session');
        $user = $request->query->get('user');
        $regle =$request->query->get('regle');
        $us = $this->getDoctrine()
        ->getRepository(Participant::class)
        ->find($user);
        $sess = $this->getDoctrine()
        ->getRepository(Session::class)
        ->find($session);
        $sess->addParticipant($us);
        $entityManager->persist($sess);
        $entityManager->flush(); 

        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        return $this->redirectToRoute('match', array('session' => $session, 'user' => $user), 301);
    }

     /**
     * @Route("/match/mesparties", name="matchmespartis")
     */
    public function mesparties(MatchRepository $matchrepo,Request $request)
    {
        $user= $request->query->get('user');
        $session = $request->query->get("session");
        return $this->render('match/mesparties.html.twig', [
            'controller_name' => 'MatchController',
            'list' => $matchrepo->findBySession($session),
            'sess'=>"sess",
        ]);
    }

     /**
     * @Route("/match/mesparties/match-encours", name="matchencours")
     */
    public function matchencours(MatchRepository $matchrepo,Request $request,SessionInterface $session1)
    {
        $match= $request->query->get('match');
        if (isset($match)) {
            $count = $session1->get("count$match");
            $session1->set("count",$match);
            if (isset($count)) {
                $count = $count+1;
                $session1->set("count$match",$count);
            }
        }
        $user= $request->query->get('user');
        $session = $request->query->get("session");
        return $this->render('match/matchencours.html.twig', [
            'controller_name' => 'MatchController',
            'list' => $matchrepo->findBySession($session),
            'sess'=>"sess",
        ]);
    }

}
