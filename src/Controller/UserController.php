<?php

namespace App\Controller;

//FORM
use App\Form\UpdateUserInfosType;
use App\Form\UpdateUserPasswordType;

//DORCTRINE
use Doctrine\ORM\EntityManagerInterface;

//SYMFONY
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    
    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'profil')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function editUser(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UpdateUserInfosType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
            ]);

        }

        return $this->render('user/editUser.html.twig', [
            'updateUserForm' => $form->createView(),
        ]);

    }

    #[Route('/editPassword', name: 'editPassword')]
    public function editPassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UpdateUserPasswordType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
            ]);

            

        }

        return $this->render('user/editUserPassword.html.twig', [
            'updateUserPasswordForm' => $form->createView(),
        ]);

    }
}
