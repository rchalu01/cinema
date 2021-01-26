<?php

namespace App\Controller;

use App\Domain\Query\ListeDeFilmsHandler;
use App\Domain\Query\ListeDeFilmsQuery;
use App\Domain\Query\UnFilmHandler;
use App\Domain\Query\UnFilmQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmResponsableProgController extends AbstractController
{
    /**
     * @Route("/respProg/films", name="liste_films")
     */
    public function listeFilms(ListeDeFilmsHandler $handler)
    {
        $query = new ListeDeFilmsQuery();
        $listeFilms = $handler->handle($query);

        return $this->render('FilmResponsableProg/listFilms.html.twig', [
            'films' => $listeFilms
        ]);
    }

    /**
     * @Route("/respProg/films/{film}", name="detail_film")
     */
    public function detailFilm(
        $film,
        UnFilmHandler $handler
    )
    {
        $unFilmQuery = new UnFilmQuery($film);
        $unFilm = $handler->handle($unFilmQuery);

        return $this->render('FilmResponsableProg/film.html.twig', [
            'film' => $unFilm,
        ]);
    }
}
