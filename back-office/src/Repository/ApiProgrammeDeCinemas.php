<?php


namespace App\Repository;


use App\Domain\ProgrammeDeCinema;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Entity\FilmAAffiche;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Unirest\Request;

/**
 * Le service permettant de gérer la programmation des films à l'affiche d'un cinéma, en faisant appel à une API.
 *
 * Class ApiProgrammeDeCinemas
 * @package App\Repository
 */
class ApiProgrammeDeCinemas implements ProgrammeDeCinema
{

    /**
     * Cette méthode permet de récupérer les films à l'affiche d'un cinéma.
     *
     * @param Cinema $cinema
     * @return iterable
     */
    public function getFilmsPourCinema(Cinema $cinema): iterable
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null,
            null,
            null,
            new ReflectionExtractor())];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $filmsResponse = Request::get('http://dfs-api/api/cinemas/' . $cinema->getId(), $headers, null);
        $filmsJson = $filmsResponse->raw_body;

        $filmsArray = json_decode($filmsJson, true);

        $films = [];
        foreach ($filmsArray as $filmElement) {
            $film = json_encode($filmElement);
            $films[] = $serializer->deserialize($film, FilmAAffiche::class, 'json');
        }
        return $films;
    }

    /**
     * Cette méthode permet de récupérer un film à l'affiche d'un cinéma
     *
     * @param Film $film
     * @param Cinema $cinema
     * @return FilmAAffiche|null
     */
    public function getFilmAAffiche(Film $film, Cinema $cinema)
    {
        // todo
    }

    /**
     *
     *
     * @param Film $film
     * @param Cinema $cinema
     */
    public function mettreFilmAAffiche(Film $film, Cinema $cinema)
    {
        $headers = array('Accept' => 'application/json');
        $postFilmAAffiche = Request::post('http://dfs-api/api/filmsAAFiche/' . $cinema->getId() . "/" . $film->getId(), $headers);
    }

    public function enleverFilmAAffiche(Film $film, Cinema $cinema)
    {
        $headers = array('Accept' => 'application/json');
        $deleteFilmAAffiche = Request::delete('http://dfs-api/api/filmsAAFiche/' . $cinema->getId() . "/" . $film->getId(), $headers);
    }

    public function viderProgrammation(Cinema $cinema)
    {
        $filmsAAffiche = $this->getFilmsPourCinema($cinema);
        foreach ($filmsAAffiche as $filmAAffiche) {
            $this->enleverFilmAAffiche($filmAAffiche->getFilm(), $cinema);
        }
    }
}