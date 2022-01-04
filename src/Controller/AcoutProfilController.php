<?php

namespace App\Controller;

use App\Form\ChangeProfilType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AcoutProfilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/acout/profil", name="acout_profil")
     */
    public function index(Request $request): Response
    {
        
        $User = $this->getUser();
        $form=$this->createForm(ChangeProfilType::class,$User);

        $form->handleRequest($request);

       if( $form->isSubmitted() && $form->isValid()){
        $User=$form->getData();

       
        $this->entityManager->persist($User);
        $this->entityManager->flush();
        return $this->redirectToRoute('chat');

       }
        return $this->render('acout_profil/index.html.twig', [
            'controller_name' => 'AcoutProfilController',
            'form' => $form->createView(),
        ]);
    }
}
