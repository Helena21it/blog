<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig',[
            'controller_name' => 'KOUAKOU',
            'articles'=>$this->articleRepository->findAll()
        ]);
    }
    /**
     * @Route("/contact/new", name="articlecreate")
     */
    public function create(Request $request): Response
    {
        $article = new Article();
        $form =$this->createForm( ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form){
            $entity=$this->getDoctrine()->getManager();
            $article= $form->getData();
            $entity->persist($article);
            $entity->flush();
        }
        return $this->renderForm('contact/blog.html.twig',[
            'formArticles'=>$form
        ]);
    }
    /**
     * @Route("/contact/{id}", name="articleId")
     */

    public function articleById($id) : Response
    {
        return $this->render('contact/index.html.twig',[
            'article'=>$this->articleRepository->find($id)
            ]);
    }
    /**
    * @Route("/contact/{city}", name="contactCity")
    */
    public function contactCity(Request $request ,string $city): Response
    {
        $customerName = $request->query->get('customerName');
        return $this->render('contact/index.html.twig', [
            'city' => $city,
            'customerName' => $customerName,

        ]);
    }
}
