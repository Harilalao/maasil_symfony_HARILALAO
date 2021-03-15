<?php
/**
 * Created by PhpStorm.
 * User: DEV-MANASSE
 * Date: 3/14/2021
 * Time: 5:50 PM
 */

namespace App\Tests;


use App\Entity\User;
use SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTest extends WebTestCase
{
    public function testConnexion()
    {
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();

        // gets the special container that allows fetching private services
        $container = self::$container;

        //### Test unitaire sur le service de connexion utilisateur admin@lithis.com mot de pass "pass" ##//
        $user = self::$container->get('doctrine')->getRepository(User::class)->findOneBy(['username'=>'admin@lithis.com']);
        $this->assertTrue(self::$container->get('security.password_encoder')->isPasswordValid($user, 'pass'));
    }

}