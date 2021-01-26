<?php

namespace App\Controller;

use App\Domain\CatalogueDeFilms;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            'filmsAAffiche' => $filmsAAffiche
        ]);
    }

    /**
     * @Route("/admin/cinemas/programmation/{cinema}", name="programmation_cinema")
     */
    public function programmationCinema(Request $request, $cinema, UnCinemaHandler $unCinemaHandler, ProgrammationCinemaHandler $programmationCinemaHandler,
                                        DefinirProgrammationCinemaHandler $handler, CatalogueDeFilms $catalogueDeFilms)
    {
        // on récupère le cinéma dont on va changer les films à l'affiche
        $unCinemaQuery = new UnCinemaQuery($cinema);
        $unCinema = $unCinemaHandler->handle($unCinemaQuery);

        // on récupère les films qui sont déjà à l'affiche de ce cinéma
        $query = new ProgrammationCinemaQuery($unCinema);
        $filmsAAffiche = $programmationCinemaHandler->handle($query);

        // on récupère la liste des films des films à l'affiche
        $films = [];
        foreach ($filmsAAffiche as $filmAAffiche) {
            $films[] = $filmAAffiche->film;
        }

        $command = new DefinirProgrammationCinemaCommand(
            $films,
            $unCinema
        );

        // on récupère tous les films
        $tousLesFilms = $catalogueDeFilms->tousLesFilms();

        $filmsNonAffiche = [];

        // si les films à l'affiche du cinéma sont dans la liste de tous les films alors on ne les ajoute pas
        foreach ($tousLesFilms as $film) {
            if (!in_array($film, $command->getFilms())) {
                $filmsNonAffiche[] = $film;
            }
        }

        $listeFilms = array_merge($command->getFilms(), $filmsNonAffiche);

        usort($listeFilms, function ($film1, $film2) {
            return $film1->id - $film2->id;
        });

        $form = $this->createFormBuilder($command)
            ->add('films', ChoiceType::class, [
                'choices' => $listeFilms,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function (?Film $film) {
                    return $film ? $film->getTitre() : '';
                }
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();

            $handler->handle($command);

            return $this->redirectToRoute('detail_cinema', ["cinema" => $unCinema->getId()]);
        }
        return $this->render('Cinema/programmationCinema.html.twig', [
            "cinema" => $unCinema,
            "form" => $form->createView(),
        ]);
    }
}