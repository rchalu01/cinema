<?php


namespace App\Domain;

use App\Entity\Cinema;

interface AnnuaireDeCinemas
{
    public function tousLesCinemas(): iterable;

    public function getCinemaPourId($cinema): Cinema;

    public function supprimercinema($cinema);
}