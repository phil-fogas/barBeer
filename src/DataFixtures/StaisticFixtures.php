<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\Statistic;
use App\Entity\Client;
use App\Entity\Beer;
use App\Entity\Category;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StaisticFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $client = $manager->getRepository(Client::class)->findAll();
         $statistic = new Statistic();
         $count = 10;

         $beer = $manager->getRepository(Beer::class)->findAll();
         $category = $manager->getRepository(Category::class)->findAll();

         while($count > 0){
            $statistic = new Statistic();
            shuffle($beer);
            $statistic->setBeer($beer[0]);
           // shuffle($category);
           // $statistic->setcategory($category[0]);
           shuffle($client);
           $statistic->setBeer($client[0]);
           $statistic->setScore($faker->randomFloat(2,1, 20));

            $count--;
            $manager->persist($statistic);
         }

        

        $manager->flush();
    }
    


    public function getOrder(){ 
    return 6; // sera faite après une autre fixture 
   }
}
