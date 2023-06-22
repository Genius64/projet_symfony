<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name'=>'Piriou',
            'firstname'=>'Killyan'
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        // view
        return $this->render('first/hello.html.twig', [
            'name' => $name,
            'firstname' => $firstname
        ]);
    }
}
