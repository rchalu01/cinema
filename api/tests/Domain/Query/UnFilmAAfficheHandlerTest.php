<?php


namespace App\Tests\Domain\Query;


use App\Domain\CatalogueDeFilms;
use App\Domain\ProgrammeDeCinema;
use App\Domain\Query\UnFilmAAfficheHandler;
use App\Domain\Query\UnFilmAAfficheQuery;
use App\Domain\Query\UnFilmHandler;
use App\Domain\Query\UnFilmQuery;
use App\Entity\Cinema;
use App\Entity\Film;
use PHPUnit\Framework\TestCase;

class UnFilmAAfficheHandlerTest extends TestCase
{
    public function test_obtenir_le_detail_d_un_film_a_affiche_interroge_le_programme_de_cinema()
    {
        // Arrange
        $unFilm = new Film("Un résumé", "un titre", "un réalisateur", "des acteurs");
        $unCinema = new Cinema("un nom", "une adresse", "une description");
        // $unCinemaQuery = new CinemaQuery

        $requete = new UnFilmAAfficheQuery($unFilm, $unCinema);
        $programmeDeCinema = $this->createMock(ProgrammeDeCinema::class);
        $handler = new UnFilmAAfficheHandler($programmeDeCinema);

        //Assert
        $programmeDeCinema->expects($this->once())->method("getFilmAAffiche");

        // Act
        $resultat = $handler->handle($requete);
    }
}