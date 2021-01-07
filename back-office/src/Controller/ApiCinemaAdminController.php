<?php

namespace App\Controller;

use App\Domain\Query\ListeCinemasHandler;
use App\Domain\Query\ListeCinemasQuery;
use App\Domain\Query\ProgrammationCinemaHandler;
use App\Domain\Query\ProgrammationCinemaQuery;
use App\Entity\Cinema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiCinemaAdminController extends AbstractController
{
    /**
     * @Route("/api/cinemas", name="api_cinemas", methods= {"GET"})
     */
    public function listeCinemas(ListeCinemasHandler $handler, SerializerInterface $serializer)
    {
        $query = new ListeCinemasQuery();
        $listeCinemas = $handler->handle($query);
        $listeCinemasJson = $serializer->serialize($listeCinemas, 'json');

        return new JsonResponse($listeCinemasJson, 200, [], true);
    }

    /**
     * @Route("/api/cinemas/{cinema}", name="api_detail_cinema", methods= {"GET"})
     */
    public function detailCinema(Cinema $cinema, ProgrammationCinemaHandler $programmationCinemaHandler, SerializerInterface $serializer)
    {
        $programmeQuery = new ProgrammationCinemaQuery($cinema);
        $filmAAffiche = $programmationCinemaHandler->handle($programmeQuery);
        $filmAAfficheJson = $serializer->serialize($filmAAffiche, 'json');

        return new JsonResponse($filmAAfficheJson, 200, [], true);
    }

    /**
     * @Route("/api/cinemas", name="api_add_cinema", methods= {"POST"})
     */
    public function addCinema(Request $request, SerializerInterface $serializer)
    {
        $data = $request->getContent();
        $cinema = $serializer->deserialize($data, Cinema::class, 'json');

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

        $cinema = $serializer->deserialize($data, Cinema::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE=>$cinema]);
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
