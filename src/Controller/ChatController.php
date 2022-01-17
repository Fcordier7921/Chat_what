<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Channel;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\ChannelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class ChatController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/chat", name="chat")
     */
    public function index(Request $request, ChannelRepository $ChannelRepository, MessageRepository $messageRepository): Response
    {
        $user = $this->getUser();
        $channel = $ChannelRepository->findAll();
        
        $messages = $messageRepository->findAll();

        $message = new Message();
        $fromMessage=$this->createForm(MessageType::class,$message);

        $fromMessage->handleRequest($request);
        if( $fromMessage->isSubmitted() && $fromMessage->isValid()){
            
           
            $this->entityManager->persist($message);
            $this->entityManager->flush();
            
           }

        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
            'user' => $user,
            'channels' => $channel,
            'messages' => $messages,
            'formMessage'=>$fromMessage->createView()
        ]);
    }
}
// https://codelabs.eleven-labs.com/course/fr/creez-un-chat-avec-symfony-et-mercure/
// tuto a suivrepour le chat