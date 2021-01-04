<?php


namespace App\Domain;

use App\Entity\Cinema;
use App\Entity\Film;

interface ProgrammeDeCinema
{
    public function getFilmsPourCinema(Cinema $cinema): iterable;

    public function mettreFilmAAffiche(Film $film, Cinema $cinema);

    public function enleverFilmAAffiche(Film $film, Cinema $cinema);
}