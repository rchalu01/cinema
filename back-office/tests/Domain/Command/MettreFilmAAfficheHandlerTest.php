<?php

namespace App\Tests\Domain\Command;

use App\Entity\Cinema;
use App\Domain\Command\MettreFilmAAfficheCommand;
use App\Domain\Command\MettreFilmAAfficheHandler;
use App\Entity\Film;
use App\Domain\ProgrammeDeCinema;
use PHPUnit\Framework\TestCase;

class MettreFilmAAfficheHandlerTest extends TestCase
{
    public function test_mettre_un_film_a_affiche_sollicite_le_programme()
    {
        // Arrange
        $film = $this->createMock(Film::class);
        $cinema = $this->createMock(Cinema::class);
        $programme = $this->createMock(ProgrammeDeCinema::class);
        $handler = new MettreFilmAAfficheHandler($programme);
        $command = new MettreFilmAAfficheCommand($film, $cinema);

        // Assert
        $programme->expects($this->once())->method("mettreFilmAAffiche");

        // Act
        $handler->handle($command);
    }
}