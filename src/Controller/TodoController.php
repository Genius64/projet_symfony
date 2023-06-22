<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // Affiche le tableau todo
        if (!$session -> has('todos')) {
            $todos = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info',"la liste des todos viens d'être initialisée");
        }
        return $this->render('todo/index.html.twig');
    }

    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content): RedirectResponse{
        $session = $request->getSession();

        if($session -> has('todos')){
            $todos = $session->get('todos');

            if (isset($todos[$name])) {
                $this->addFlash('error',"le todo d'id $name éxiste déjà dans la liste");
            }else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('succes',"le todo d'id $name à été ajouté avec succès dans la liste");
            }

        }else{
            $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse{
        $session = $request->getSession();

        if($session -> has('todos')){
            $todos = $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error',"le todo d'id $name n'éxiste pas dans la liste");
            }else{
                $todos[$name] = $content;
                $session->set('todos',$todos);
                $this->addFlash('succes',"le todo d'id $name à été modifier avec succès");
            }

        }else{
            $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse{
        $session = $request->getSession();

        if($session -> has('todos')){
            $todos = $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error',"le todo d'id $name n'éxiste pas dans la liste");
            }else{
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('succes',"le todo d'id $name à été supprimé avec succès");
            }

        }else{
            $this->addFlash('error',"la liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todo');
    }
    #[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse{
        $session = $request->getSession();

        $session->remove('todos');

        return $this->redirectToRoute('todo');
    }
}
