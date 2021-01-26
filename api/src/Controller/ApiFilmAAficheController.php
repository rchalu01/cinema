<?php

namespace App\Controller;

use App\Domain\Command\DefinirProgrammationCinemaHandler;
use App\Domain\Command\EnleverFilmAAfficheCommand;
use App\Domain\Command\EnleverFilmAAfficheHandler;
use App\Domain\Command\MettreFilmAAfficheCommand;
use App\Domain\Command\MettreFilmAAfficheHandler;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Entity\FilmAAffiche;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ApiFilmAAficheController extends AbstractController
{
    /**
     * @Rest\View(serializerGroups={"filmsAAFiche"})
     * @Rest\Get("/api/filmsAAFiche/{cinema}", name="api_films_a_affiche")
     */
    public function listeFilmsAAfiche(
        Cinema $cinema,
        ProgrammationCinemaHandler $handler)
    {
        $query = new ProgrammationCinemaQuery($cinema);
        $listeFilmsAAFiche = $handler->handle($query);
        return $listeFilmsAAFiche;
    }

    /**
     * @Rest\View()
     * @Rest\Post("/api/filmsAAFiche/{cinema}/{film}", name="api_add_film_a_affiche")
     */
    public function postFilmAAfiche(
        Cinema $cinema,
        Film $film,
        MettreFilmAAfficheHandler $handler,
        ValidatorInterface $validator)
    {
        $filmAAffiche = new FilmAAffiche($film, $cinema);

        $errors = $validator->validate($filmAAffiche);
        if (count($errors))
            return View::create($errors, Response::HTTP_FOUND);

        $command = new MettreFilmAAfficheCommand($film, $cinema);
        $handler->handle($command);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/api/filmsAAFiche/{cinema}/{film}", name="api_delete_film_a_affiche")
     */
    public function deleteFilmAAfiche(
        Cinema $cinema,
        Film $film,
        EnleverFilmAAfficheHandler $handler)
    {
        $command = new EnleverFilmAAfficheCommand($film, $cinema);
        $handler->handle($command);
    }
}
