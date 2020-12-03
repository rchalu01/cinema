<?php


namespace App\Domain;

interface AnnuaireDeCinemas
{
    public function tousLesCinemas(): iterable;

    public function getCinemaPourId($idCinema): Cinema;
}