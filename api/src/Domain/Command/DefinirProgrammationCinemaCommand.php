<?php


namespace App\Domain\Command;


class DefinirProgrammationCinemaCommand
{
    private $films;
    private $cinema;

    /**
     * DefinirProgrammationCinemaCommand constructor.
     * @param $films
     * @param $cinema
     */
    public function __construct($films, $cinema)
    {
        $this->films = $films;
        $this->cinema = $cinema;
    }

    /**
     * @return mixed
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * @return mixed
     */
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * @param mixed $films
     */
    public function setFilms($films): void
    {
        $this->films = $films;
    }

    /**
     * @param mixed $cinema
     */
    public function setCinema($cinema): void
    {
        $this->cinema = $cinema;
    }

}