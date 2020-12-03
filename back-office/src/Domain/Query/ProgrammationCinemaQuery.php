<?php

namespace App\Domain\Query;

class ProgrammationCinemaQuery
{
    private $cinema;

    /**
     * ProgrammationCinemaQuery constructor.
     */
    public function __construct($cinema)
    {
        $this->cinema = $cinema;
    }

    /**
     * @return mixed
     */
    public function getCinema()
    {
        return $this->cinema;
    }
}