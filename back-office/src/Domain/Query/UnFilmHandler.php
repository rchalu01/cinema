<?php


namespace App\Domain\Query;


use App\Domain\CatalogueDeFilms;
use App\Domain\Film;

class UnFilmHandler
{

    private $catalogueDeFilms;

    /**
     * UnFilmHandler constructor.
     * @param CatalogueDeFilms $catalogueDeFilms
     */
    public function __construct(CatalogueDeFilms $catalogueDeFilms)
    {
        $this->catalogueDeFilms = $catalogueDeFilms;
    }

    public function handle(UnFilmQuery $requete): Film
    {
        return $this->catalogueDeFilms->getFilmPourId($requete->getIdFilm());
    }
}