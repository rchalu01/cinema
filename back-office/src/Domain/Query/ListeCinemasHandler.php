<?php


namespace App\Domain\Query;


use App\Domain\AnnuaireDeCinemas;

class ListeCinemasHandler
{
    private $annuaire;

    /**
     * ListeCinemasHandler constructor.
     * @param AnnuaireDeCinemas $annuaireDeCinemas
     */
    public function __construct(AnnuaireDeCinemas $annuaireDeCinemas)
    {
        $this->annuaire = $annuaireDeCinemas;
    }

    public function handle(ListeCinemasQuery $requete):iterable
    {
        return $this->annuaire->tousLesCinemas();
    }

}