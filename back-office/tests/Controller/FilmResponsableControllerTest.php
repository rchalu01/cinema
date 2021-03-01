<?php


namespace App\Tests\Controller;


use App\Entity\Cinema;
use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FilmResponsableControllerTest extends WebTestCase
{

    /** @var Cinema */
    private $unCinema;
    /** @var Film */
    private $unFilm;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $container = self::$container;
        $this->unCinema = $container->get("App\Domain\AnnuaireDeCinemas")->tousLesCinemas()[0];
        $this->unFilm = $container->get("App\Domain\CatalogueDeFilms")->tousLesFilms()[0];
    }

    public function test_la_liste_des_films_affiche_les_films()
    {
        $crawler=$this->client->request('GET', '/respProg/films');

        // Il faut vérifier que la contenu de la page contient une liste de cinémas avec leurs infos
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Avengers")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Xmen")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Justice League")')->count()
        );
    }

    public function test_page_detail_film_est_disponible()
    {
        $this->client->request('GET', '/respProg/films/' . $this->unFilm->getId());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function test_le_detail_du_film_affiche_les_infos_du_film()
    {
        $crawler=$this->client->request('GET', '/respProg/films/' . $this->unFilm->getId());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("' . $this->unFilm->getTitre() . '")')->count()
        );
    }
}