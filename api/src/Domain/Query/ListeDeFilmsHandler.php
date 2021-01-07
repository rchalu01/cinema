<?php


namespace App\Domain\Query;


use App\Domain\CatalogueDeFilms;

class ListeDeFilmsHandler
{
    private $catalogueDeFilms;

    /**
     * ListeDeFilmsHandler constructor.
     * @param CatalogueDeFilms $catalogueDeFilms
     */
    public function __construct(CatalogueDeFilms $catalogueDeFilms)
    {
        $this->catalogueDeFilms = $catalogueDeFilms;
    }

    public function handle(ListeDeFilmsQuery $requete):iterable
    {
        return $this->catalogueDeFilms->tousLesFilms();
    }

}