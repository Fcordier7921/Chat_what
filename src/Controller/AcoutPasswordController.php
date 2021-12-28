<?php

namespace App\Controller;

use App\Form\ChagePaswordType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AcoutPasswordController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    /**
     * @Route("/chat/modif-mon-mot-de-passe", name="acout_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        $user = $this->getUser();
        $form = $this->createForm(ChagePaswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $oldPassword)) {
                $new_pass = $form->get('new_password')->getData();
                $pasword = $encoder->encodePassword($user, $new_pass);
                $user->setPassword($pasword);
                $this->entityManager->flush();
                $notification = 'Votre mot de passe a été modifié avec succès';
            }else{
            $notification = 'Votre mot de passe actuel est incorrect';
        }
        }

        return $this->render('security/acoutPassword.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }
}
