<?php

namespace App\Repository;

use App\Domain\CatalogueDeFilms;
use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Le service permettant de gérer la liste de tous les films, en faisant appel à une base de données interne.
 *
 * Class DoctrineCatalogueDeFilms
 * @package App\Repository
 */
class DoctrineCatalogueDeFilms extends ServiceEntityRepository implements CatalogueDeFilms
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * Cette méthode permet de récupérer tous les films
     *
     * @return iterable
     */
    public function tousLesFilms(): iterable
    {
        return $this->findAll();
    }

    /**
     * Cette méthode permet de récupérer un film par son id
     *
     * @param $film
     * @return Film
     */
    public function getFilmPourId($film): Film
    {
        return $this->find($film);
    }
}