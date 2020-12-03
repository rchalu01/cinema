<?php
namespace App\Tests\Domain\Query;
use App\Domain\CatalogueDeFilms;

use App\Domain\Query\ListeDeFilmsHandler;
use App\Domain\Query\ListeDeFilmsQuery;

use PHPUnit\Framework\TestCase;

class ListeDeFilmsHandlerTest extends TestCase
{
    public function test_obtenir_la_liste_de_films_disponibles_interroge_1_catalogue(){
        // Arrange
        $requete=new ListeDeFilmsQuery();
        $catalogueDeFilms = $this->createMock(CatalogueDeFilms::class);
        $handler=new ListeDeFilmsHandler($catalogueDeFilms);

        //Assert
        $catalogueDeFilms->expects($this->once())->method("tousLesFilms");

        // Act
        $listeDeFilms=$handler->handle($requete);
    }
}