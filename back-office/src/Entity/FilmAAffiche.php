<?php

namespace App\Entity;

use App\Repository\DoctrineProgrammeDeCinemas;
use Doctrine\ORM\Mapping as ORM;

/**
 * Un film à l'affiche d'un cinéma
 *
 * @ORM\Entity(repositoryClass=DoctrineProgrammeDeCinemas::class)
 */
class FilmAAffiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cinema::class, inversedBy="filmAAffiches")
     * @ORM\JoinColumn(nullable=false)
     */
    public $cinema;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="filmAAffiches")
     * @ORM\JoinColumn(nullable=false)
     */
    public $film;

    /**
     * FilmAAffiche constructor.
     * @param $cinema
     * @param $film
     */
    public function __construct($cinema, $film)
    {
        $this->cinema = $cinema;
        $this->film = $film;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getCinema(): ?Cinema
    {
        return $this->cinema;
    }

    public function setCinema(?Cinema $cinema): self
    {
        $this->cinema = $cinema;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }
}
