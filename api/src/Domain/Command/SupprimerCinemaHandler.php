<?php


namespace App\Domain\Command;


use App\Domain\AnnuaireDeCinemas;

class SupprimerCinemaHandler
{
    private $annuaireDeCinemas;

    /**
     * SupprimerCinemaHandler constructor.
     */
    public function __construct(AnnuaireDeCinemas $annuaireDeCinemas)
    {
        $this->annuaireDeCinemas = $annuaireDeCinemas;
    }

    public function handle(SupprimerCinemaCommand $command)
    {
        $this->annuaireDeCinemas->supprimerCinema($command->getCinema());
    }
}