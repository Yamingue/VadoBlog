<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/view/{id}.html", name="view")
     */
    public function view(Article $article=null,Request $r)
    {
        $comment= new Comment();
        $form= $this->createForm(CommentType::class,$comment);
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setArticle($article);
            $comment->setPublishAt(new \Datetime());
            $m= $this->getDoctrine()->getManager();
            $m->persist($comment);
            $m->flush();

        }
        return $this->render('articles/view.html.twig', [
            'article' => $article,
            'form'=> $form->createView(),
        ]);
    }
    /**
     * @Route("/", name="articles")
     */
    public function index(ArticleRepository $ar)
    {
        $articles= $ar->findAll();
        return $this->render('articles/home.html.twig', [
            'articles' => $articles,
        ]);
    }
     /**
     * @Route("/edit/{id}", name="articles_edit")
     */
    public function edit(Article $article=null,Request $req)
    {
        $form= $this->createForm(ArticleType::class,$article);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $article->setUpdateAt(new \Datetime());
            $em->persist($article);
            $em->flush();
            $photos= $form->get('photos')->getData();
            foreach ($photos as  $value) {
                $img= ['png','jpg','jpeg','gif','JPJ','JPEG','PNG','GIF'];
                $ext=$value->guessExtension();
                $name=$value->getClientOriginalName();
                
                if ( in_array($ext,$img) ) {
                    $image= new Image();
                    $image->setChemin('img/'.$name);
                    $m=$this->getDoctrine()->getManager();
                    $m->persist($image);
                    $m->flush();
                    $article->addImage($image);
                    $value->move('img',$name);
                    
                }
            } 
            $em->flush();
        }

        return $this->render('articles/edite.html.twig', [
            'form' => $form->createView(),
            'images'=>$article->getImages(),
        ]);
    }
    /**
     * @Route("/new", name="articles_new")
     */
    public function new(Request $r)
    {
        $article = new Article();
        $form= $this->createForm(ArticleType::class,$article);
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $article->setPublishAt(new \Datetime());
            $article->setUpdateAt(new \Datetime());
            $em->persist($article);
            $em->flush();
            $photos= $form->get('photos')->getData();
            foreach ($photos as  $value) {
                $img= ['png','jpg','jpeg','gif','JPJ','JPEG','PNG','GIF'];
                $ext=$value->guessExtension();
                $name=$value->getClientOriginalName();
                
                if ( in_array($ext,$img) ) {
                    $image= new Image();
                    $image->setChemin('img/'.$name);
                    $m=$this->getDoctrine()->getManager();
                    $m->persist($image);
                    $m->flush();
                    $article->addImage($image);
                    $value->move('img',$name);
                }
            } 
            $em->flush();
            return $this->redirectToRoute('articles_edit',['id'=>$article->getId()]);
        }
        return $this->render('articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
     /**
     * @Route("-read-{id}.html", name="articles_read")
     */
    public function read(Article $ar=null)
    {
        return $this->render('articles/read.html.twig', [
            'article' => $ar,
        ]);
    }
}
