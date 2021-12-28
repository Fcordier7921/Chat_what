<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        

        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
            'user' => $user,
        ]);
    }
}
