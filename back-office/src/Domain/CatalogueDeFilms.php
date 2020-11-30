<?php


namespace App\Domain;

interface CatalogueDeFilms
{
    public function tousLesFilms():iterable;
}