<?php


namespace App\Domain;

use App\Entity\Cinema;

interface AnnuaireDeCinemas
{
    public function tousLesCinemas(): iterable;

    public function getCinemaPourId($idCinema): Cinema;
}