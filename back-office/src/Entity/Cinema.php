<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineAnnuaireDeCinemas")
 */
class Cinema
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=FilmAAffiche::class, mappedBy="cinema")
     */
    private $filmAAffiches;

    /**
     * Cinema constructor.
     * @param $nom
     * @param $adresse
     * @param $description
     */
    public function __construct($nom, $adresse, $description)
    {
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->description = $description;
        $this->filmAAffiches = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Collection|FilmAAffiche[]
     */
    public function getFilmAAffiches(): Collection
    {
        return $this->filmAAffiches;
    }

    public function addFilmAAffich(FilmAAffiche $filmAAffich): self
    {
        if (!$this->filmAAffiches->contains($filmAAffich)) {
            $this->filmAAffiches[] = $filmAAffich;
            $filmAAffich->setCinema($this);
        }

        return $this;
    }

    public function removeFilmAAffich(FilmAAffiche $filmAAffich): self
    {
        if ($this->filmAAffiches->removeElement($filmAAffich)) {
            // set the owning side to null (unless already changed)
            if ($filmAAffich->getCinema() === $this) {
                $filmAAffich->setCinema(null);
            }
        }

        return $this;
    }
}