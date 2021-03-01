<?php


namespace App\Domain\Query;


class UnFilmAAfficheQuery
{
    private $film;
    private $cinema;

    /**
     * UnFilmAAfficheQuery constructor.
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
     * @return mixed
     */
    public function getCinema()
    {
        return $this->cinema;
    }
}