<?php

namespace App\Repository;

use App\Domain\ProgrammeDeCinema;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Entity\FilmAAffiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Unirest\Request;

/**
 * @method FilmAAffiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmAAffiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmAAffiche[]    findAll()
 * @method FilmAAffiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineProgrammeDeCinemas extends ServiceEntityRepository implements ProgrammeDeCinema
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmAAffiche::class);
    }

    // /**
    //  * @return FilmAAffiche[] Returns an array of FilmAAffiche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilmAAffiche
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getFilmsPourCinema(Cinema $cinema): iterable
    {
        return $this->findBy([
            "cinema" => $cinema,
        ]);
    }

    public function mettreFilmAAffiche(Film $film, Cinema $cinema)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        //$headers = array('Accept' => 'application/json');
        $data = array('cinema' => $cinema, 'film' => $film);

        $body = Request\Body::json($data);
        $response = Request::post('http://dfs-api/api/filmsAAFiche', null, $body);
    }


    public function enleverFilmAAffiche(Film $film, Cinema $cinema)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $headers = array('Accept' => 'application/json');
        $body = array('cinema' => $cinema, 'film' => $film);

        //$body = Request\Body::json($data);
        $response = Request::delete('http://dfs-api/api/filmsAAFiche', $headers, $body);
    }

    public function viderProgrammation(Cinema $cinema)
    {

    }
}
