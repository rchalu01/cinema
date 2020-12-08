<?php
namespace App\Tests\Domain\Command;
use App\Domain\Cinema;
use App\Domain\Command\EnleverFilmAAfficheCommand;
use App\Domain\Command\EnleverFilmAAfficheHandler;
use App\Domain\Film;
use App\Domain\ProgrammeDeCinema;
use PHPUnit\Framework\TestCase;

class EnleverFilmAAfficheHandlerTest extends TestCase
{
    public function test_enlever_un_film_a_affiche_sollicite_le_programme(){
        // Arrange
        $film=$this->createMock(Film::class);
        $cinema=$this->createMock(Cinema::class);
        $programme=$this->createMock(ProgrammeDeCinema::class);
        $handler=new EnleverFilmAAfficheHandler($programme);
        $command=new EnleverFilmAAfficheCommand($film,$cinema);

        // Assert
        $programme->expects($this->once())->method("enleverFilmAAffiche");

        // Act
        $handler->handle($command);
    }
}