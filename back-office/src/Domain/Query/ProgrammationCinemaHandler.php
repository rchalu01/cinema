<?php


namespace App\Domain\Query;


use App\Domain\AnnuaireDeCinemas;
use App\Domain\ProgrammeDeCinema;

class ProgrammationCinemaHandler
{
    private $programmeDeCinema;
    private $annuaireDeCinemas;

    /**
     * ListeDeFilmsHandler constructor.
     * @param ProgrammeDeCinema $programmeDeCinema
     */
    public function __construct(ProgrammeDeCinema $programmeDeCinema, AnnuaireDeCinemas $annuaireDeCinemas)
    {
        $this->programmeDeCinema = $programmeDeCinema;
        $this->annuaireDeCinemas = $annuaireDeCinemas;
    }

    public function handle(ProgrammationCinemaQuery $requete): iterable
    {
        return $this->programmeDeCinema->getFilmsPourCinema($requete->getCinema());
    }

}