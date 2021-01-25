<?php


namespace App\Tests\Domain\Command;

use App\Domain\AnnuaireDeCinemas;
use App\Domain\Command\SupprimerCinemaCommand;
use App\Domain\Command\SupprimerCinemaHandler;
use App\Entity\Cinema;
use PHPUnit\Framework\TestCase;

class SupprimerCinemaHandlerTest extends TestCase
{
    public function test_supprimer_un_cinema_sollicite_l_annuaire_de_cinemas(){
        // Arrange
        $cinema=$this->createMock(Cinema::class);
        $annuaireDeCinemas=$this->createMock(AnnuaireDeCinemas::class);
        $handler=new SupprimerCinemaHandler($annuaireDeCinemas);
        $command=new SupprimerCinemaCommand($cinema);

        // Assert
        $annuaireDeCinemas->expects($this->once())->method("supprimerCinema");

        // Act
        $handler->handle($command);
    }
}