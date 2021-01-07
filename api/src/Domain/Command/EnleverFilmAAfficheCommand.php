<?php

namespace App\Domain\Command;

use App\Entity\Cinema;
use App\Entity\Film;

class EnleverFilmAAfficheCommand
{
    private $film;
    private $cinema;

    /**
     * EnleverFilmAAfficheCommand constructor.
     * @param Film $film
     * @param Cinema $cinema
     */
    public function __construct(Film $film, Cinema $cinema)
    {
        $this->film = $film;
        $this->cinema = $cinema;
    }

    /**
     * @return mixed
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @param mixed $film
     */
    public function setFilm($film): void
    {
        $this->film = $film;
    }

    /**
     * @return mixed
     */
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * @param mixed $cinema
     */
    public function setCinema($cinema): void
    {
        $this->cinema = $cinema;
    }
}