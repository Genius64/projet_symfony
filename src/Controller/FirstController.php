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

    #[Route('/sayHello', name: 'say.hello')]
    public function sayHello(): Response
    {
        $rand = rand(0,10);
        if($rand % 2 == 0){
            return $this->redirectToRoute(route:'first');
        }
        return $this->forward('App\Controller\FirstController::index', []);
    }
}
