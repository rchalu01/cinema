<?php

namespace App\Repository;

use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Le service permettant de gérer la liste de tous les cinémas, en faisant appel à une base de données interne.
 *
 * Class DoctrineAnnuaireDeCinemas
 * @package App\Repository
 */
class DoctrineAnnuaireDeCinemas extends ServiceEntityRepository implements AnnuaireDeCinemas
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cinema::class);
    }

    /**
     * Cette méthode permet de récupérer la liste des cinémas
     *
     * @return iterable
     */
    public function tousLesCinemas(): iterable
    {
        return $this->findAll();
    }

    /**
     * Cette méthode permet de récupérer un cinéma par son id
     *
     * @param $cinema
     * @return Cinema
     */
    public function getCinemaPourId($cinema): Cinema
    {
        return $this->find($cinema);
    }

    /**
     * Cette méthode permet de supprimer un cinéma
     *
     * @param $cinema
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function supprimerCinema($cinema)
    {
        $em = $this->getEntityManager();
        $em->remove($cinema);
        $em->flush();
    }
}