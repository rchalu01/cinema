<?php

namespace App\DataFixtures;

use App\Entity\Cinema;
use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // création de cinemas
        $lafayette = new Cinema("cinéma à l'ancienne", '12, rue des fleurs', 'Cinema epique');
        $manager->persist($lafayette);

        $gaumont = new Cinema('Gaumont', "5 rue François de Vaux de Folletier 17000 La Rochelle", 'Meilleur cinéma');
        $manager->persist($gaumont);

        $cgr = new Cinema('CGR', "5 rue de la paix", 'Cinema gourmand');
        $manager->persist($cgr);

        // création de films
        $avergers = new Film('Un film marvel avec des superheros','Avengers','Chris','captain tony vision');
        $manager->persist($avergers);

        $xmen = new Film('Un film marvel avec des mutants','Xmen','Nolan','xavier charles magneto misstic');
        $manager->persist($xmen);

        $justiceLeague = new Film('Un film DC avec des superheros','Justice League','Spielberg','Superman lex');
        $manager->persist($justiceLeague);

        $suicideSquad = new Film('Un film Dc avec des supervilains','Suicide Squad','Mister jesaispas','Joker harley quin feufeu');
        $manager->persist($suicideSquad);

        $manager->flush();
    }
}
