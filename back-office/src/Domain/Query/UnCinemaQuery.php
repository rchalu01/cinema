<?php


namespace App\Domain\Query;


class UnCinemaQuery
{
    private $idCinema;

    /**
     * UnFilmQuery constructor.
     * @param $idCinema
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

    /**
     * @param mixed $idCinema
     */
    public function setIdCinema($idCinema): void
    {
        $this->idCinema = $idCinema;
    }

}