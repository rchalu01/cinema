<?php


namespace App\Domain\Query;


use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;

class UnCinemaHandler
{
    private $annuaireDeCinemas;

    /**
     * UnFilmHandler constructor.
     * @param AnnuaireDeCinemas $annuaireDeCinemas
     */
    public function __construct(AnnuaireDeCinemas $annuaireDeCinemas)
    {
        $this->annuaireDeCinemas = $annuaireDeCinemas;
    }

    public function handle(UnCinemaQuery $requete): Cinema
    {
        return $this->annuaireDeCinemas->getCinemaPourId($requete->getIdCinema());
    }
}