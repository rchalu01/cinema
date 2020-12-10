<?php


namespace App\Domain;

use App\Entity\Film;

interface CatalogueDeFilms
{
    public function tousLesFilms(): iterable;

    public function getFilmPourId($idFilm): Film;
}