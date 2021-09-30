<?php

namespace App\Controller;
use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Category;
use App\Entity\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Beer::class);
        $beers = $repository->findAll();
        //dd($beers);

        return $this->render('bar/index.html.twig', [
            
            'beers'=>$beers,
            'title'=>"page d'accueil"
        ]);
    }

     /**
     * @Route("/country/{id}", name="showBeerCountry")
     */
    public function showBeerCountry(Country $country): Response
    {
     
        return $this->render('beer/show.html.twig', [
            'beers'=>$country->getBeers() ?? [],
            'title'=>$country->getName()
        ]);
    }

    /**
     * @Route("/category/{id}", name="showBeerCategory")
     */
    public function showBeerCategory(Category $category): Response
    {
     
        return $this->render('category/show.html.twig', [
            'beers'=>$category->getCategori() ?? [],
            'title'=>$category->getName()
        ]);
    }
   
     /**
     * @Route("/menu", name="menu")
     */
    public function mainMenu(string $routeName, int $catId = null): response
    {
        $categories=$this->getDoctrine()->getRepository(Category::class)->findBy(['tern'=>'normal']);

        return $this->render('partials/menu.html.twig', [
          'routename'=>$routeName,
          'catid'=>$catId,
          'categories'=>$categories
        ]);
    }
     /**
     * @Route("/user", name="user")
     */
    public function showsClient(Client $client): response
    {
       
       // dump($client);
        return $this->render('client/index.html.twig', [
          'client'=>$client,
          'title'=>'client'
          
        ]);
    }
  
}
