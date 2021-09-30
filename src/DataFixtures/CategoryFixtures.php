<?php

namespace App\DataFixtures;
use App\Entity\Category;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    // catégories normals
$categoriesNormals = ['blonde', 'brune', 'blanche'];

// catégories specials
$categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'] ;
//$count=20;
$faker = Faker\Factory::create();

foreach($categoriesNormals as $normal){
    $category = new Category();  
    $category->setName($normal);
    
    $category->setDescription($faker->text(rand(10, 50)));
    $manager->persist($category); 
}

foreach($categoriesSpecials as $special){
    $category = new Category();  
    $category->setName($special);
    $category->setTern('special');
    $category->setDescription($faker->text(rand(10, 50)));
    $manager->persist($category); 
}
//while($count > 0){
//    $category = new Category();  
//shuffle($categoriesNormals);
//foreach($categoriesNormals as $name){
 //   $name=$name;
//} 
//$tern=null;
//for($t=1;$t<random_int(1,3);$t++){
 //    shuffle($categoriesSpecials);
  // foreach($categoriesSpecials as $term){
 //   if($tern!=$term){
  //      $tern.=$term;
  //  }
//}    
//}
 

 //$category->setName($faker->word);
 //$category->setName($name.' '.$tern);

 //  $category->setTern($tern);
    
   
//$count--;
// $manager->persist($category); 
//}
   

$manager->flush();
    }

    public function getOrder(){ 
        return 2; // sera faite après une autre fixture 
       }
}

