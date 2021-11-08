<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(): Response
    {
        return $this->render('contact/index.html.twig',[
            'controller_name' => 'KOUAKOU',
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
