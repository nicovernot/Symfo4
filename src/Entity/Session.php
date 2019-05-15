<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", mappedBy="session")
     */
    private $films;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", mappedBy="session")
     */
    private $participants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="session")
     */
    private $matches;


    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->matches = new ArrayCollection();
    
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->addSession($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->contains($film)) {
            $this->films->removeElement($film);
            $film->removeSession($this);
        }

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->addSession($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            $participant->removeSession($this);
        }

        return $this;
    }

public function __toString()
{
    return $this->getNom();
}

/**
 * @return Collection|Match[]
 */
public function getMatches(): Collection
{
    return $this->matches;
}

public function addMatch(Match $match): self
{
    if (!$this->matches->contains($match)) {
        $this->matches[] = $match;
        $match->setSession($this);
    }

    return $this;
}

public function removeMatch(Match $match): self
{
    if ($this->matches->contains($match)) {
        $this->matches->removeElement($match);
        // set the owning side to null (unless already changed)
        if ($match->getSession() === $this) {
            $match->setSession(null);
        }
    }

    return $this;
}

}
