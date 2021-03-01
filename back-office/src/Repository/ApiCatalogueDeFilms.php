<?php


namespace App\Repository;


use App\Domain\CatalogueDeFilms;
use App\Entity\Film;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Unirest\Request;

/**
 * Le service permettant de gérer la liste de tous les films, en faisant appel à une API.
 *
 * Class ApiCatalogueDeFilms
 * @package App\Repository
 */
class ApiCatalogueDeFilms implements CatalogueDeFilms
{

    /**
     * Cette méthode permet de récupérer tous les films
     *
     * @return iterable
     */
    public function tousLesFilms(): iterable
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $filmResponse = Request::get('http://dfs-api/api/films', $headers, null);
        $filmsJson = $filmResponse->raw_body;

        $filmsArray = json_decode($filmsJson, true);
        $films = [];
        foreach ($filmsArray as $filmElement) {
            $film = json_encode($filmElement);
            $films[] = $serializer->deserialize($film, Film::class, 'json');
        }
        return $films; // tester que ce n'est pas null
    }

    /**
     * Cette méthode permet de récupérer un film par son id
     *
     * @param $film
     * @return Film
     */
    public function getFilmPourId($film): Film
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $filmResponse = Request::get('http://dfs-api/api/films/' . $film, $headers, null);
        $filmJson = $filmResponse->raw_body;

        $filmsArray = json_decode($filmJson, true);
        $film = $serializer->deserialize(json_encode($filmsArray), Film::class, 'json');

        return $film; // tester que ce n'est pas null
    }
}