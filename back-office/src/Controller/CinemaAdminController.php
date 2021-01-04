<?php

namespace App\Controller;

use App\Domain\Query\ListeCinemasHandler;
use App\Domain\Query\ListeCinemasQuery;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Entity\Cinema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CinemaAdminController extends AbstractController
{
    /**
     * @Route("/admin/cinemas", name="liste_cinemas")
     */
    public function listeCinemas(ListeCinemasHandler $handler)
    {
        $query = new ListeCinemasQuery();
        $listeCinemas = $handler->handle($query);
        return $this->render('Cinema/listCinemas.html.twig', [
            'cinemas' => $listeCinemas
        ]);
    }

    /**
     * @Route("/admin/cinemas/{cinema}", name="detail_cinema")
     */
    public function detailCinema(
        Cinema $cinema,
        ProgrammationCinemaHandler $programmationCinemaHandler
    )
    {
        $programmeQuery = new ProgrammationCinemaQuery($cinema);
        $filmsAAffiche = $programmationCinemaHandler->handle($programmeQuery);


        return $this->render('Cinema/cinema.html.twig', [
            'cinema' => $cinema,
            'filmsAAffiche' => $filmsAAffiche,
        ]);
    }
}