<?php
namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController 
{
     /**
      * @Route("/",name="home")
     * @Route("/index", name="index")
     */
    public function index(ArticleRepository $ar)
    {
        
        return $this->render('articles/home.html.twig', [
            'articles' => $ar->findAll(),
        ]);
    }
}