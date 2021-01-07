<?php
namespace App\Tests\Controller;
use App\Domain\AnnuaireDeCinemas;
use App\Entity\Cinema;
use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CinemaAdminControllerTest extends WebTestCase
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

    public function test_page_cinemas_est_disponible()
    {
        $this->client->request('GET', '/admin/cinemas');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function test_la_liste_des_cinemas_affiche_les_cinemas()
    {
        $crawler=$this->client->request('GET', '/admin/cinemas');

        // Il faut vérifier que la contenu de la page contient une liste de cinémas avec leurs infos
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Gaumont")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("5 rue François de Vaux de Folletier 17000 La Rochelle")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Meilleur cinéma")')->count()
        );
    }

    private function unCinema():Cinema
    {
        $container = self::$container;
        /** @var AnnuaireDeCinemas $annuaire */
        $annuaire=$container->get("App\Domain\AnnuaireDeCinemas");
        return $annuaire->tousLesCinemas()[0];
    }

    public function test_page_cinema_est_disponible()
    {
        $idCinema=$this->unCinema()->getId();
        $this->client->request('GET', '/admin/cinemas/'.$idCinema);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function test_la_page_d_un_cinema_affiche_les_films_a_l_affiche()
    {
        $idCinema=$this->unCinema->getId();
        $titreFilm=$this->unFilm->getTitre();

        $crawler=$this->client->request('GET', '/admin/cinemas/'.$idCinema);

        // Il faut vérifier que la contenu de la page contient le titre du film.
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$titreFilm.'")')->count()
        );
    }
}
