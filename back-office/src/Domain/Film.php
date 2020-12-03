<?php


namespace App\Domain;


class Film
{

    private $id;
    private $resume;
    private $titre;
    private $realisateur;
    private $acteursPrincipaux;

    /**
     * Film constructor.
     * @param $id
     * @param $resume
     * @param $titre
     * @param $realisateur
     * @param $acteursPrincipaux
     */
    public function __construct($id, $resume, $titre, $realisateur, $acteursPrincipaux)
    {
        $this->id = $id;
        $this->resume = $resume;
        $this->titre = $titre;
        $this->realisateur = $realisateur;
        $this->acteursPrincipaux = $acteursPrincipaux;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @return mixed
     */
    public function getActeursPrincipaux()
    {
        return $this->acteursPrincipaux;
    }
}