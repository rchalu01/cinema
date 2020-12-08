<?php


namespace App\Domain;

interface ProgrammeDeCinema
{
    public function getFilmsPourCinema(Cinema $cinema): iterable;

    public function mettreFilmAAffiche(Film $film, Cinema $cinema);
}