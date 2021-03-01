<?php


namespace App\Repository;

use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Unirest\Request;

/**
 * Le service permettant de gérer la liste de tous les cinémas, en faisant appel à une API.
 *
 * Class ApiAnnuaireDeCinemas
 * @package App\Repository
 */
class ApiAnnuaireDeCinemas implements AnnuaireDeCinemas
{

    /**
     * Cette méthode permet de récupérer la liste des cinémas
     *
     * @return iterable
     */
    public function tousLesCinemas(): iterable
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $cinemaResponse = Request::get('http://dfs-api/api/cinemas', $headers, null);
        $cinemasJson = $cinemaResponse->raw_body;

        $cinemasArray = json_decode($cinemasJson, true);
        $cinemas = [];
        foreach ($cinemasArray as $cinemaElement) {
            $cinema = json_encode($cinemaElement);
            $cinemas[] = $serializer->deserialize($cinema, Cinema::class, 'json');
        }
        return $cinemas; // tester que ce n'est pas null
    }

    /**
     * Cette méthode permet de récupérer un cinéma par son id
     *
     * @param $cinemaId
     * @return Cinema
     */
    public function getCinemaPourId($cinemaId): Cinema
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $cinemaResponse = Request::get('http://dfs-api/api/cinemas/info/'.$cinemaId, $headers, null);
        $cinemaJson = $cinemaResponse->raw_body;

        $cinemasArray = json_decode($cinemaJson, true);
        $cinema = $serializer->deserialize(json_encode($cinemasArray), Cinema::class,'json');

        return $cinema; // tester que ce n'est pas null
    }

    public function supprimercinema($cinema)
    {
        // TODO: Implement supprimercinema() method.
    }
}