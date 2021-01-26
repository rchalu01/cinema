<?php

namespace App\Repository;

use App\Domain\ProgrammeDeCinema;
use App\Entity\Cinema;
use App\Entity\Film;
use App\Entity\FilmAAffiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Le service permettant de gérer la programmation des films à l'affiche d'un cinéma, en faisant appel à une base de données interne.
 *
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

    /**
     * Cette méthode permet de récupérer les films à l'affiche d'un cinéma.
     *
     * @param Cinema $cinema
     * @return iterable
     */
    public function getFilmsPourCinema(Cinema $cinema): iterable
    {
        return $this->findBy([
            "cinema" => $cinema,
        ]);
    }

    /**
     * Cette méthode permet de récupérer un film à l'affiche d'un cinéma
     *
     * @param Film $film
     * @param Cinema $cinema
     * @return FilmAAffiche|null
     */
    public function getFilmAAffiche(Film $film, Cinema $cinema)
    {
        return $this->findOneBy(["film" => $film, "cinema" => $cinema]);
    }

    /**
     * Cette méthode permet de mettre un film à l'affiche d'un cinéma
     *
     * @param Film $film
     * @param Cinema $cinema
     */
    public function mettreFilmAAffiche(Film $film, Cinema $cinema)
    {
        $filmAAffiche = new FilmAAffiche($film, $cinema);
        $this->save($filmAAffiche);
    }

    /**
     * Cette méthode permet d'enlever un film à l'affiche d'un cinéma
     *
     * @param Film $film
     * @param Cinema $cinema
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function enleverFilmAAffiche(Film $film, Cinema $cinema)
    {
        $filmAAffiche = $this->getFilmAAffiche($film, $cinema);

        $em = $this->getEntityManager();
        $em->remove($filmAAffiche);
        $em->flush();
    }

    /**
     * Cette méthode permet d'enregistrer un film à l'affiche en base de données
     *
     * @param FilmAAffiche $filmAAffiche
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(FilmAAffiche $filmAAffiche)
    {
        $em = $this->getEntityManager();
        $em->persist($filmAAffiche);
        $em->flush();
    }

    /**
     * Cette méthode permet d'enlever tous les films à l'affiche d'un cinéma
     *
     * @param Cinema $cinema
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
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
