<?php

namespace App\Repository;

use App\Domain\AnnuaireDeCinemas;
use App\Domain\Cinema;

class InMemoryAnnuaireDeCinema implements AnnuaireDeCinemas
{
    public function tousLesCinemas(): iterable
    {
        return [
            new Cinema(1,"MegaCGR","12 rue des fleurs",""),
        ];
    }

    public function getCinemaPourId($idCinema): Cinema
    {
        // TODO: Implement getCinemaPourId() method.
    }
}