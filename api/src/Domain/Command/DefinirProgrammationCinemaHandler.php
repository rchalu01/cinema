<?php


namespace App\Domain\Command;


use App\Domain\ProgrammeDeCinema;

class DefinirProgrammationCinemaHandler
{
    private $programme;

    /**
     * DefinirProgrammationCinemaHandler constructor.
     */
    public function __construct(ProgrammeDeCinema $programme)
    {
        $this->programme = $programme;
    }

    public function handle(DefinirProgrammationCinemaCommand $command)
    {
        $this->programme->viderProgrammation($command->getCinema());
        $films = $command->getFilms();
        $cinema = $command->getCinema();
        foreach ($films as $film) {
            $this->programme->mettreFilmAAffiche($film, $cinema);
        }
    }
}