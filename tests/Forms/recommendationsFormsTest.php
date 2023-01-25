<?php
// tests/Form/RecommendationsFormTest.php
namespace App\Tests\Form;


use App\Entity\Movies;
use App\Entity\Recommendations;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecommendationsFormTest extends KernelTestCase
{

    public function testNewRecommendations()
    {
        $recommendations = (new Recommendations())
            ->setForbiddenAge('toto');

        self::bootKernel();
        $container = static::getContainer();
        $error = $container->get('validator')->validate($recommendations);
        $this->assertCount(0, $error);
    }
}
