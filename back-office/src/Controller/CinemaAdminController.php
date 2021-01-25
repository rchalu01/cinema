<?php

namespace App\Controller;

use App\Domain\Command\DefinirProgrammationCinemaCommand;
use App\Domain\Command\DefinirProgrammationCinemaHandler;
use App\Domain\ProgrammeDeCinema;
use App\Domain\Query\ListeCinemasHandler;
use App\Domain\Query\ListeCinemasQuery;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Domain\Query\UnCinemaHandler;
use App\Domain\Query\UnCinemaQuery;
use App\Entity\Cinema;
use App\Entity\Film;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        $cinema,
        ProgrammationCinemaHandler $programmationCinemaHandler,
        UnCinemaHandler $unCinemaHandler
    )
    {
        $unCinemaQuery = new UnCinemaQuery($cinema);
        $unCinema = $unCinemaHandler->handle($unCinemaQuery);

        $programmeQuery = new ProgrammationCinemaQuery($unCinema);
        $filmsAAffiche = $programmationCinemaHandler->handle($programmeQuery);
        return $this->render('Cinema/cinema.html.twig', [
            'cinema' => $unCinema,
            'filmsAAffiche'=>$filmsAAffiche
        ]);
    }

    /**
     * @Route("/admin/cinemas/programmation/{cinema}", name="programmation_cinema")
     */
    public function programmationCinema(Request $request, Cinema $cinema, ProgrammeDeCinema $programmeDeCinema,
                                        DefinirProgrammationCinemaHandler $handler)
    {
        $filmsAAffiche = $programmeDeCinema->getFilmsPourCinema($cinema);
        $films = [];
        foreach ($filmsAAffiche as $filmAAffiche) {
            $films[]=$filmAAffiche->film;
        }
        $command = new DefinirProgrammationCinemaCommand(
            $films,
            $cinema
        );

        $form = $this->createFormBuilder($command)
            ->add('films', EntityType::class, [
                'class' => Film::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();
            $handler->handle($command);

            return $this->redirectToRoute('detail_cinema', ["cinema" => $cinema->getId()]);
        }
        return $this->render('Cinema/programmationCinema.html.twig', [
            "cinema" => $cinema,
            "form" => $form->createView(),
        ]);
    }
}