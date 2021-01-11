<?php


namespace App\Domain\Command;


use App\Domain\ProgrammeDeCinema;

class MettreFilmAAfficheHandler
{
    private $programme;

    /**
     * MettreFilmAAfficheHandler constructor.
     */
    public function __construct(ProgrammeDeCinema $programme)
    {
        $this->programme = $programme;
    }

    public function handle(MettreFilmAAfficheCommand $command)
    {
        $this->programme->mettreFilmAAffiche($command->getFilm(),$command->getCinema());
    }
}