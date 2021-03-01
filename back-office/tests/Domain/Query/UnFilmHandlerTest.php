<?php


namespace App\Tests\Domain\Query;

use App\Domain\CatalogueDeFilms;
use App\Domain\Query\UnFilmHandler;
use App\Domain\Query\UnFilmQuery;
use PHPUnit\Framework\TestCase;

class UnFilmHandlerTest extends TestCase
{

    public function test_obtenir_le_detail_d_un_film_interroge_le_catalogue_de_films()
    {
        // Arrange
        $requete = new UnFilmQuery(2);
        $catalogueDeFilms = $this->createMock(CatalogueDeFilms::class);
        $handler = new UnFilmHandler($catalogueDeFilms);

        //Assert
        $catalogueDeFilms->expects($this->once())->method("getFilmPourId");

        // Act
        $resultat = $handler->handle($requete);
    }
}