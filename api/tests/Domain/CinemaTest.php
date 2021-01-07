<?php

namespace App\Domain;

use App\Entity\Cinema;
use PHPUnit\Framework\TestCase;

class CinemaTest extends TestCase
{
    public function test_un_cinema_expose_ses_informations()
    {
        $cinema = new Cinema("Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals("Le Lafayette", $cinema->getNom());
        $this->assertEquals("15 rue de Vaux de Folletier", $cinema->getAdresse());
        $this->assertEquals("Très bon cinéma", $cinema->getDescription());
    }
}