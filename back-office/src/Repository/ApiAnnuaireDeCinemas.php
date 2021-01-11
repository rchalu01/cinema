<?php


namespace App\Repository;

use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use Unirest\Request;

class ApiAnnuaireDeCinemas implements AnnuaireDeCinemas
{

    public function tousLesCinemas(): iterable
    {
        $headers = array('Accept' => 'application/json');
        $cinemaResponse = Request::get('http://dfs-api/api/cinemas', $headers, null);
        $cinemas = $cinemaResponse->body;
        return $cinemas; // tester que ce n'est pas null
    }

    public function getCinemaPourId($cinemaId): Cinema
    {
        /*$cinemas = $this->tousLesCinemas();
        foreach ($cinemas as $cinema) {
            return $cinema ? ($cinema->getId() == $cinemaId) : null; // créer une route qui fait revenir un cinema
        }*/
        // return null;
    }
}