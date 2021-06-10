<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\UserInformationType;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/information", name="information")
     */
    public function information(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserInformationType::class, $this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($this->getUser());
            $entityManager->flush();
            $this->addFlash('success', 'Informations de profil mis à jour');
        }
        return $this->render('user/information.html.twig', [
            'form_information' => $form->createView()
        ]);
    }

    /**
     * @Route("/favorite", name="favorite")
     */
    public function favorite(UserRepository $userRepository): Response
    {
        return $this->render('user/favorite.html.twig');
    }


    /**
     * @Route("/password", name="password")
     */
    public function password(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $request->request->get('change_password')['oldPassword'];
            if ($encoder->isPasswordValid($user, $oldPassword)) {
                $newPassword = $request->request->get('change_password')['password']['first'];
                $newEncodedPassword = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($newEncodedPassword);
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Votre mot de passe a été changé avec succès');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }
        return $this->render('user/password.html.twig', [
            'form_password' => $form->createView()
        ]);
    }

    /**
     * @Route("/rent", name="rent")
     */
    public function rent(UserRepository $userRepository, RentRepository $rentRepository): Response
    {
        $userMail = $this->getUser()->getUsername();
        $userId = $userRepository->findOneBy(['email' => $userMail])->getId();
        $rents = $rentRepository->findBy(['user' => $userId]);
        return $this->render('user/rent.html.twig', [
            'rents' => $rents
        ]);
    }
}
