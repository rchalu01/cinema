<?php


namespace App\Domain\Command;


use App\Domain\ProgrammeDeCinema;

class EnleverFilmAAfficheHandler
{
    private $programme;

    /**
     * EnleverFilmAAfficheHandler constructor.
     */
    public function __construct(ProgrammeDeCinema $programme)
    {
        $this->programme = $programme;
    }

    public function handle(EnleverFilmAAfficheCommand $command)
    {
        $this->programme->enleverFilmAAffiche($command->getFilm(),$command->getCinema());
    }
}