<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function index(Request $request): Response
    {
        // session_start()
        $session = $request->getSession();

        if ($session -> has('nbVisite')) {
            $nbrVisite = $session -> get('nbVisite') + 1 ;
        }else{
            $nbrVisite = 1;
        }
        $session -> set('nbVisite', $nbrVisite);

        return $this->render('session/index.html.twig');
    }
}