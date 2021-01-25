<?php

namespace App\Repository;

use App\Domain\ProgrammeDeCinema;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Entity\FilmAAffiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function getFilmsPourCinema(Cinema $cinema): iterable
    {
        return $this->findBy([
            "cinema" => $cinema,
        ]);
    }

    public function getFilmAAffiche(Film $film, Cinema $cinema)
    {
        return $this->findOneBy(["film" => $film, "cinema" => $cinema]);
    }

    public function mettreFilmAAffiche(Film $film, Cinema $cinema)
    {
        $filmAAffiche = new FilmAAffiche($film, $cinema);
        $this->save($filmAAffiche);
    }

    public function enleverFilmAAffiche(Film $film, Cinema $cinema)
    {
        $filmAAffiche = $this->getFilmAAffiche($film, $cinema);

        $em = $this->getEntityManager();
        $em->remove($filmAAffiche);
        $em->flush();
    }

    public function save(FilmAAffiche $filmAAffiche)
    {
        $em = $this->getEntityManager();
        $em->persist($filmAAffiche);
        $em->flush();
    }

    public function viderProgrammation(Cinema $cinema)
    {
        $em = $this->getEntityManager();

        $filmsAAffiche = $this->getFilmsPourCinema($cinema);
        foreach ($filmsAAffiche as $film) {
            $em->remove($film);
        }

        $em->flush();
    }
}
