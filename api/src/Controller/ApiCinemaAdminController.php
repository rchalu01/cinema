<?php

namespace App\Controller;

use App\Domain\Query\ListeCinemasHandler;
use App\Domain\Query\ListeCinemasQuery;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Entity\Cinema;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiCinemaAdminController extends AbstractController
{
    /**
     * @Rest\View()
     * @Rest\Get("/api/cinemas",name="api_cinemas")
     */
    public function listeCinemas(ListeCinemasHandler $handler)
    {
        $query = new ListeCinemasQuery();
        $listeCinemas = $handler->handle($query);

        return $listeCinemas;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/cinemas/{cinema}", name="api_detail_cinema")
     */
    public function detailCinema(Cinema $cinema, ProgrammationCinemaHandler $handler)
    {
        $query = new ProgrammationCinemaQuery($cinema);
        $filmsAAffiche = $handler->handle($query);

        return $filmsAAffiche;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/cinemas", name="api_add_cinema")
     */
    public function addCinema(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $data = $request->getContent();
        $cinema = $serializer->deserialize($data, Cinema::class, 'json');

        $errors = $validator->validate($cinema);
        if (count($errors)) {
            return View::create($errors, Response::HTTP_NOT_FOUND);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cinema);
        $entityManager->flush();

        return new JsonResponse('', Response::HTTP_CREATED, [], true);
    }

    /**
     * @Route("/api/cinemas/{cinema}", name="api_update_cinema", methods= {"PUT"})
     */
    public function updateCinema(Cinema $cinema, Request $request, SerializerInterface $serializer)
    {
        $data = $request->getContent();

        $cinema = $serializer->deserialize($data, Cinema::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $cinema]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cinema);
        $entityManager->flush();

        return new JsonResponse('', Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/cinemas/{cinema}", name="api_delete_cinema", methods= {"DELETE"})
     */
    public function deleteCinema(Cinema $cinema, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($cinema);
        $entityManager->flush();

        return new JsonResponse('', Response::HTTP_OK, [], true);
    }
}
