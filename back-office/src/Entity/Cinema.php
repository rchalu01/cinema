<?php

namespace App\Entity;

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
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $adresse;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $description;

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
}