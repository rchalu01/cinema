<?php
namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CinemaAdminControllerTest extends WebTestCase
{
    public function test_page_cinemas_est_disponible()
    {
        $client = static::createClient();
        $client->request('GET', '/admin/cinemas');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test_la_liste_des_cinemas_affiche_les_cinemas()
    {
        $client = static::createClient();

        $crawler=$client->request('GET', '/admin/cinemas');

        // Il faut vérifier que la contenu de la page contient une liste de cinémas.
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Gaumont")')->count()
        );
    }
}
