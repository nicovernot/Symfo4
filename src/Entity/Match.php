<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @ORM\Table(name="`match`")
 */
class Match 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="matches")
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Regle", inversedBy="matches")
     */
    private $regle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="matches")
     */
    private $participant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getRegle(): ?Regle
    {
        return $this->regle;
    }

    public function setRegle(?Regle $regle): self
    {
        $this->regle = $regle;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }
}
