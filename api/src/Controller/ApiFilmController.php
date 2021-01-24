<?php

namespace App\Controller;

use App\Domain\Query\ListeDeFilmsHandler;
use App\Domain\Query\ListeDeFilmsQuery;
use App\Domain\Query\UnFilmHandler;
use App\Domain\Query\UnFilmQuery;
use App\Entity\Film;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiFilmController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/api/films",name="api_films")
     */
    public function listeFilms(ListeDeFilmsHandler $listeDeFilmsHandler)
    {
        $listeDeFilmsQuery = new ListeDeFilmsQuery();
        $listeFilms = $listeDeFilmsHandler->handle($listeDeFilmsQuery);

        return $listeFilms;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/films/{film}", name="api_detail_film")
     */
    public function detailFilm(Film $film, UnFilmHandler $unFilmHandler)
    {
        $unFilmQuery = new UnFilmQuery($film);
        $film = $unFilmHandler->handle($unFilmQuery);

        return $film;
    }
}
