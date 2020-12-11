<?php

namespace App\Repository;

use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAnnuaireDeCinemas extends ServiceEntityRepository implements AnnuaireDeCinemas
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cinema::class);
    }

    public function tousLesCinemas(): iterable
    {
        return $this->findAll();
    }

    public function getCinemaPourId($cinema): Cinema
    {
        return $this->find($cinema);
    }
}