<?php

namespace App\Domain;

class Cinema
{
    private $id;
    private $nom;
    private $adresse;
    private $description;

    /**
     * Cinema constructor.
     * @param $id
     * @param $nom
     * @param $adresse
     * @param $description
     */
    public function __construct($id, $nom, $adresse, $description)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->description = $description;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
}