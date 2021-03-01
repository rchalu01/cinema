<?php


namespace App\Domain\Command;


use App\Entity\Cinema;

class SupprimerCinemaCommand
{
    private $cinema;

    /**
     * SupprimerCinemaCommand constructor.
     * @param Cinema $cinema
     */
    public function __construct(Cinema $cinema)
    {
        $this->cinema = $cinema;
    }

    /**
     * @return Cinema
     */
    public function getCinema(): Cinema
    {
        return $this->cinema;
    }

    /**
     * @param Cinema $cinema
     */
    public function setCinema(Cinema $cinema): void
    {
        $this->cinema = $cinema;
    }

}