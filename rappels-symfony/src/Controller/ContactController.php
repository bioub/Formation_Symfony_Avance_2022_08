<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts')]
    public function index(): Response
    {
        $doctrine = $this->getDoctrine();
        // Connection -> DBAL -> requetes SQL bas niveau
        $connection = $doctrine->getConnection();

        // Ecriture d'entité -> Manager -> EntityManager (si ORM)
        $manager = $doctrine->getManager();

        // Lecture d'entité  -> Repository -> EntiryRepository (si ORM)
        $repository = $doctrine->getRepository(Contact::class);

        return $this->render('contact/index.html.twig', [
            'contacts' => $repository->findAll(),
        ]);
    }

    #[Route('/hello')]
    public function hello(): Response
    {
        //return new Response("", 301, ['Location' => 'https://www.google.com/']);
        return $this->redirect('https://www.google.com/');
    }

    #[Route('/api/hello')]
    public function apiHello(): Response
    {
        //return new Response("", 301, ['Location' => 'https://www.google.com/']);
        return $this->json(['msg' => 'Hello']);
    }

    #[Route('/contacts/add')]
    public function add(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
