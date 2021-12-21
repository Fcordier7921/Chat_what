<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {

        $User=new User();
        $form=$this->createForm(RegisterType::class,$User);

        $form->handleRequest($request);

       if( $form->isSubmitted() && $form->isValid()){
        $User=$form->getData();

        $password=$encoder->encodePassword($User,$User->getPassword());
        $User->setPassword($password);
       
        $this->entityManager->persist($User);
        $this->entityManager->flush();
       }
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'form'=>$form->createView()
        ]);
    }
}
