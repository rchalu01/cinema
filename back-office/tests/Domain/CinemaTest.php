<?php

namespace App\Domain;

use PHPUnit\Framework\TestCase;

class CinemaTest extends TestCase
{
    public function test_un_cinema_expose_son_id()
    {
        $cinema = new Cinema(1, "Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals(1, $cinema->getId());
    }
    public function test_un_cinema_expose_son_nom()
    {
        $cinema = new Cinema(1, "Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals("Le Lafayette", $cinema->getNom());
    }

    public function test_un_cinema_expose_son_adresse()
    {
        $cinema = new Cinema(1, "Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals("15 rue de Vaux de Folletier", $cinema->getAdresse());
    }

    public function test_un_cinema_expose_sa_description()
    {
        $cinema = new Cinema(1, "Le Lafayette", "15 rue de Vaux de Folletier", "Très bon cinéma",);
        $this->assertEquals("Très bon cinéma", $cinema->getDescription());
    }
}