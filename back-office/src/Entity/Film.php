<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineCatalogueDeFilms")
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
     * @ORM\Column(type="text", nullable=false)
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $acteursPrincipaux;

    /**
     * @ORM\OneToMany(targetEntity=FilmAAffiche::class, mappedBy="film")
     */
    private $filmAAffiches;

    /**
     * Film constructor.
     * @param $resume
     * @param $titre
     * @param $realisateur
     * @param $acteursPrincipaux
     */
    public function __construct($resume, $titre, $realisateur, $acteursPrincipaux)
    {
        $this->resume = $resume;
        $this->titre = $titre;
        $this->realisateur = $realisateur;
        $this->acteursPrincipaux = $acteursPrincipaux;
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
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @return mixed
     */
    public function getActeursPrincipaux()
    {
        return $this->acteursPrincipaux;
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
            $filmAAffich->setFilm($this);
        }

        return $this;
    }

    public function removeFilmAAffich(FilmAAffiche $filmAAffich): self
    {
        if ($this->filmAAffiches->removeElement($filmAAffich)) {
            // set the owning side to null (unless already changed)
            if ($filmAAffich->getFilm() === $this) {
                $filmAAffich->setFilm(null);
            }
        }

        return $this;
    }
}