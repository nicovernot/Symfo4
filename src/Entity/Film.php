<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Regle", mappedBy="film")
     */
    private $regles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="film")
     */
    private $matches;

    public function __construct()
    {
        $this->regles = new ArrayCollection();
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

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return Collection|Regle[]
     */
    public function getRegles(): Collection
    {
        return $this->regles;
    }

    public function addRegle(Regle $regle): self
    {
        if (!$this->regles->contains($regle)) {
            $this->regles[] = $regle;
            $regle->setFilm($this);
        }

        return $this;
    }

    public function removeRegle(Regle $regle): self
    {
        if ($this->regles->contains($regle)) {
            $this->regles->removeElement($regle);
            // set the owning side to null (unless already changed)
            if ($regle->getFilm() === $this) {
                $regle->setFilm(null);
            }
        }

        return $this;
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
            $match->setFilm($this);
        }

        return $this;
    }

    public function removeMatch(Match $match): self
    {
        if ($this->matches->contains($match)) {
            $this->matches->removeElement($match);
            // set the owning side to null (unless already changed)
            if ($match->getFilm() === $this) {
                $match->setFilm(null);
            }
        }

        return $this;
    }
}
