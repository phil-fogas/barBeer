<?php

namespace App\DataFixtures;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        
        $faker = Faker\Factory::create('fr_FR');
        $client = new Client();
        $client->setName($faker->name);
        $client->setAge(rand(18, 90));
        $client->setEmail($faker->email);

        $manager->persist($client);
        $manager->flush();
    }
    
 

    public function getOrder(){ 
        return 5; // sera faite après une autre fixture 
       }
}
