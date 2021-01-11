<?php


namespace App\Domain\Query;


class UnFilmQuery
{

    private $idFilm;

    /**
     * UnFilmQuery constructor.
     * @param $idFilm
     */
    public function __construct($idFilm)
    {
        $this->idFilm = $idFilm;
    }

    /**
     * @return mixed
     */
    public function getIdFilm()
    {
        return $this->idFilm;
    }
}