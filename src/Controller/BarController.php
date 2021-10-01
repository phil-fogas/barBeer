<?php

namespace App\Controller;
use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\User;
use App\Entity\Statistic;
use App\Form\StatisticType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class BarController extends AbstractController
{
    
       
   
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if(!empty($this->getUser())){
            $idclient=$this->getDoctrine()->getRepository(Client::class)->findBy(['user'=>$this->getUser()->getId()]); 
            $stat=$this->getDoctrine()->getRepository(Statistic::class)->findBy(['client'=>$idclient[0]]);    
            }
        $repository = $this->getDoctrine()->getRepository(Beer::class);
        $beers = $repository->findAll();
        //dd($beers);

        return $this->render('bar/index.html.twig', [
            
            'beers'=>$beers,
            'title'=>"page d'accueil",
            'stat'=>$stat??[]
        ]);
    }

     /**
     * @Route("/country/{id}", name="showBeerCountry")
     */
    public function showBeerCountry(Country $country): Response
    {
        $from =$this->createForm(StatisticType::class);

        if(!empty($this->getUser())){
            $idclient=$this->getDoctrine()->getRepository(Client::class)->findBy(['user'=>$this->getUser()->getId()]); 
            $stat=$this->getDoctrine()->getRepository(Statistic::class)->findBy(['client'=>$idclient[0]]);    
            }
            
        return $this->render('country/show.html.twig', [
            'beers'=>$country->getBeers() ?? [],
            'title'=>$country->getName(),
            'from'=>$from->createView(),
            'stat'=>$stat??[]
            
        ]);
    }

    /**
     * @Route("/category/{id}", name="showBeerCategory")
     */
    public function showBeerCategory(Category $category,Request $request): Response
    {
        $new=new Statistic();
     $from =$this->createForm(StatisticType::class,$new);
     $from->handleRequest($request);
        
     if(!empty($this->getUser())){
     $idclient=$this->getDoctrine()->getRepository(Client::class)->findBy(['user'=>$this->getUser()->getId()]); 
     $stat=$this->getDoctrine()->getRepository(Statistic::class)->findBy(['client'=>$idclient[0]]);    
     }
     
     
        return $this->render('category/show.html.twig', [
            'beers'=>$category->getCategori() ?? [],
            'title'=>$category->getName(),
            'from'=>$from->createView(),
            'stat'=>$stat??[]
        ]);
    }
    /**
     * @Route("/beer/{id}", name="showBeer")
     */
    public function showBeer(Beer $beer,Request $request,$id): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $repository=$entityManager->getRepository(Statistic::class);  
        $new=$repository->findOneBy(['Beer'=>$id]);
     $from =$this->createForm(StatisticType::class,$new);
     $from->handleRequest($request);
     
     if ($from->isSubmitted())
     {
         $new=$from->getData();
         $entityManager=$this->getDoctrine()->getManager();
         $entityManager->persist($new);
         $entityManager->flush();
         return $this->redirectToRoute('home');
     }  

     if(!empty($this->getUser())){
     $idclient=$this->getDoctrine()->getRepository(Client::class)->findBy(['user'=>$this->getUser()->getId()]); 
     $stat=$this->getDoctrine()->getRepository(Statistic::class)->findBy(['client'=>$idclient[0]]);    
     }
     
     $beer = $this->getDoctrine()->getRepository(Beer::class)->find($id);
        return $this->render('beer/show.html.twig', [
            'beer'=>$beer ?? [],
            'title'=>$beer->getName(),
            'from'=>$from->createView(),
            'stat'=>$stat??[]
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
    public function showsClient(): response
    {      
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
       
        $client=$this->getDoctrine()->getRepository(Client::class)->findBy(['user'=>$this->getUser()->getId()]);
        return $this->render('client/index.html.twig', [
          'clients'=>$client??[],
          'title'=>'client'
          
        ]);
    }

  
}
