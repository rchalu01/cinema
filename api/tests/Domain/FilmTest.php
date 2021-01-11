<?php


namespace App\Domain;


use App\Entity\Film;
use PHPUnit\Framework\TestCase;

class FilmTest extends TestCase
{

    public function test_un_film_expose_ses_informations()
    {
        $film = new Film("Trop bien", "Romain, developpeur aguéris", "Quentin Darphel", array("Lucien", "Alexis"));
        $this->assertEquals("Trop bien", $film->getResume());
        $this->assertEquals("Romain, developpeur aguéris", $film->getTitre());
        $this->assertEquals("Quentin Darphel", $film->getRealisateur());
        $this->assertEquals(array("Lucien", "Alexis"), $film->getActeursPrincipaux());
    }
}