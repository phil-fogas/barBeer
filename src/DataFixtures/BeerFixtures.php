<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Category;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BeerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        // on fixe le nombre de bière à insérer dans les variables d'environnements
        $count = $_ENV["APP_FIXTURES_NB_BEERS"] ?? 20;

        $countries = $manager->getRepository(Country::class)->findAll();
        $categoryNormals = $manager->getRepository(Category::class)->findByTern('normal');
        $categorySpecials = $manager->getRepository(Category::class)->findByTern('special');
        $nbSpecial=count($categorySpecials);

        while($count > 0){
            shuffle($countries); // mélange le tableau par référence
            $beer = new Beer();
            $beer->setName($faker->word);
            $beer->setPublishedAt($faker->dateTime());
            $beer->setDescription($faker->text(rand(200, 500)));
            $country = array_slice($countries, 0, 1); // renvoie un tableau
            // dump($country);
            $beer->setCountry($country[0]);
           
            shuffle($categorySpecials);
           $beer->addCategory($categoryNormals[0]);
           shuffle($categoryNormals);
          foreach(array_slice($categorySpecials,0,rand(1,$nbSpecial)) as $catspecial){
            $beer->addCategory($catspecial);  
          }
         
            $beer->setPrice($faker->randomFloat(2,2, 20));
            $count--;
            $manager->persist($beer);
        }

        $manager->flush();  
    }
    
   public function getOrder(){ 
    return 3; // sera faite après une autre fixture 
   }
}