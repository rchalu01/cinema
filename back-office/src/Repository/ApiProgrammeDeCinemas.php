<?php


namespace App\Repository;


use App\Domain\ProgrammeDeCinema;
use App\Entity\Cinema;
use App\Entity\Film;
use Unirest\Request;

class ApiProgrammeDeCinemas implements ProgrammeDeCinema
{

    public function getFilmsPourCinema(Cinema $cinema): iterable
    {
        $headers = array('Accept' => 'application/json');
        $filmsResponse = Request::get('http://dfs-api/api/cinemas/'.$cinema->getId(), $headers, null);
        $filmsJson = $filmsResponse->body;

        return $filmsJson; // tester que ce n'est pas null
    }

    public function mettreFilmAAffiche(Film $film, Cinema $cinema)
    {
        // TODO: Implement mettreFilmAAffiche() method.
    }

    public function enleverFilmAAffiche(Film $film, Cinema $cinema)
    {
        // TODO: Implement enleverFilmAAffiche() method.
    }

    public function viderProgrammation(Cinema $cinema)
    {
        // TODO: Implement viderProgrammation() method.
    }
}