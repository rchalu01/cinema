<?php

namespace App\Domain\Query;

class ProgrammationCinemaQuery
{
    private $idCinema;

    /**
     * ProgrammationCinemaQuery constructor.
     */
    public function __construct($idCinema)
    {
        $this->idCinema = $idCinema;
    }

    /**
     * @return mixed
     */
    public function getIdCinema()
    {
        return $this->idCinema;
    }
}