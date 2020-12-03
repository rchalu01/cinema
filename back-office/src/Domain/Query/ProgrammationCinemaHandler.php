<?php


namespace App\Domain\Query;


use App\Domain\ProgrammeDeCinema;

class ProgrammationCinemaHandler
{
    private $programmeDeCinema;

    /**
     * ListeDeFilmsHandler constructor.
     * @param ProgrammeDeCinema $programmeDeCinema
     */
    public function __construct(ProgrammeDeCinema $programmeDeCinema)
    {
        $this->programmeDeCinema = $programmeDeCinema;
    }

    public function handle(ProgrammationCinemaQuery $requete):iterable
    {
        return $this->programmeDeCinema->getFilmsPourCinema($requete->getCinema());
    }

}