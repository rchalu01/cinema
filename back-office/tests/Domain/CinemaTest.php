<?php

namespace App\Domain;

use PHPUnit\Framework\TestCase;

class CinemaTest extends TestCase
{
    public function test_un_cinema_expose_ses_informations()
    {
        $cinema = new Cinema(1, "Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals(1, $cinema->getId());
        $this->assertEquals("Le Lafayette", $cinema->getNom());
        $this->assertEquals("15 rue de Vaux de Folletier", $cinema->getAdresse());
        $this->assertEquals("Très bon cinéma", $cinema->getDescription());
    }
}