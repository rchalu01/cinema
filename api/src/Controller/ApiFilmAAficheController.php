<?php

namespace App\Controller;

use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Entity\Cinema;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiFilmAAficheController extends AbstractController
{
    /**
     * @Rest\View(serializerGroups={"filmsAAFiche"})
     * @Rest\Get("/api/filmsAAFiche/{cinema}")
     */
    public function listeFilmsAAfiche(
        Cinema $cinema,
        ProgrammationCinemaHandler $handler)
    {
        // dd($cinema);
        $query = new ProgrammationCinemaQuery($cinema);
        $listeFilmsAAFiche = $handler->handle($query);
        // dd($listeFilmsAAFiche);
        return $listeFilmsAAFiche;
    }
}
