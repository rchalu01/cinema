<?php

namespace App\Tests\Domain\Query;

use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use App\Domain\ProgrammeDeCinema;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use PHPUnit\Framework\TestCase;

class ProgrammationCinemaHandlerTest extends TestCase
{
    public function test_lister_les_films_a_l_affiche_sollicite_le_programme_du_cinema()
    {
        // Arrange
        $query = new ProgrammationCinemaQuery(1);
        $programme = $this->createMock(ProgrammeDeCinema::class);
        $annuaireDeCinema = $this->createMock(AnnuaireDeCinemas::class);

            // Assert (préparation)
        $programme->expects($this->once())->method("getFilmsPourCinema");

        //Arrange
        $handler = new ProgrammationCinemaHandler($programme, $annuaireDeCinema);

        //Act
        $resultat = $handler->handle($query);

        //Assert
        $this->assertIsIterable($resultat);

    }
}