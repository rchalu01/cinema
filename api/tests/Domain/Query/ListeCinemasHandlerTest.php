<?php
namespace App\Tests\Domain\Query;
use App\Domain\AnnuaireDeCinemas;

use App\Domain\Query\ListeCinemasHandler;
use App\Domain\Query\ListeCinemasQuery;

use PHPUnit\Framework\TestCase;

class ListeCinemasHandlerTest extends TestCase
{
    public function test_obtenir_la_liste_de_cinemas_interroge_l_annuaire(){
        // Arrange
        $requete=new ListeCinemasQuery();
        $annuaire = $this->createMock(AnnuaireDeCinemas::class);
        $handler=new ListeCinemasHandler($annuaire);

        //Assert
        $annuaire->expects($this->once())->method("tousLesCinemas");

        // Act
        $listeDeCinemas=$handler->handle($requete);
    }
}