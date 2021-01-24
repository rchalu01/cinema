<?php

namespace App\Tests\Domain\Command;

use App\Domain\Command\DefinirProgrammationCinemaCommand;
use App\Domain\Command\DefinirProgrammationCinemaHandler;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Domain\ProgrammeDeCinema;
use PHPUnit\Framework\TestCase;

class DefinirProgrammationCinemaHandlerTest extends TestCase
{
    public function test_definir_la_programmation_ajoute_les_films_a_l_affiche(){
        // Arrange
        $film1=$this->createMock(Film::class);
        $film2=$this->createMock(Film::class);
        $cinema=$this->createMock(Cinema::class);
        $programmeDeCinema = $this->createMock(ProgrammeDeCinema::class);
        $handler=new DefinirProgrammationCinemaHandler($programmeDeCinema);
        $command=new DefinirProgrammationCinemaCommand([$film1,$film2],$cinema);

        // Assert
        $programmeDeCinema->expects($this->exactly(2))->method("mettreFilmAAffiche");

        // Act
        $handler->handle($command);
    }

    public function test_definir_la_programmation_vide_les_films_a_l_affiche(){
        // Arrange
        $cinema=$this->createMock(Cinema::class);
        $programmeDeCinema = $this->createMock(ProgrammeDeCinema::class);
        $handler=new DefinirProgrammationCinemaHandler($programmeDeCinema);
        $command=new DefinirProgrammationCinemaCommand([],$cinema);

        // Assert
        $programmeDeCinema->expects($this->once())->method("viderProgrammation")->with($cinema);

        // Act
        $handler->handle($command);
    }
}