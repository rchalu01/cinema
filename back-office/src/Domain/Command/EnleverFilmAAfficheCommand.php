<?php

namespace App\Domain\Command;

class EnleverFilmAAfficheCommand
{
    private $film;
    private $cinema;

    /**
     * EnleverFilmAAfficheCommand constructor.
     * @param $film
     * @param $cinema
     */
    public function __construct($film, $cinema)
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