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
    public $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    public $resume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $titre;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    public $realisateur;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    public $acteursPrincipaux;


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

    public function __toString()
    {
        return $this->getTitre();
    }

}