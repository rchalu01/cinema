<?php


namespace App\Domain\Query;


use App\Domain\ProgrammeDeCinema;
use App\Entity\FilmAAffiche;

class UnFilmAAfficheHandler
{
    private $programmeDeCinema;

    /**
     * UnFilmHandler constructor.
     * @param ProgrammeDeCinema $programmeDeCinema
     */
    public function __construct(ProgrammeDeCinema $programmeDeCinema)
    {
        $this->programmeDeCinema = $programmeDeCinema;
    }

    public function handle(UnFilmAAfficheQuery $requete): FilmAAffiche
    {
        return $this->programmeDeCinema->getFilmAAffiche($requete->getFilm(), $requete->getCinema());
    }
}