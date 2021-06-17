<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddressType;
use App\Form\ChangePasswordType;
use App\Form\UserInformationType;
use App\Repository\BasketRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/user", name="user_")
 * @IsGranted("ROLE_USER")
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
     * @Route("/handle/favorite/{product}", name="handle_favorite")
     */
    public function handleFavorite(Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getFavorites()->contains($product)) {
            $this->getUser()->removeFavorite($product);
            $entityManager->persist($this->getUser());
            $entityManager->flush();
            $this->addFlash('warning', 'Produit retiré de vos favoris !');
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        } else {
            $this->getUser()->addFavorite($product);
            $entityManager->persist($this->getUser());
            $entityManager->flush();
            $this->addFlash('success', 'Produit ajouté à vos favoris !');
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }
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
            }
        }
        return $this->render('user/password.html.twig', [
            'form_password' => $form->createView()
        ]);
    }

    /**
     * @Route("/rent", name="rent")
     */
    public function rent(BasketRepository $basketRepository): Response
    {
        $baskets = $basketRepository->findby(['user' => $this->getUser(), 'isOpen' => false]);
        $rents = [];
        foreach ($baskets as $basket) {
            $rents[] = $basket->getRent();
        }

        return $this->render('user/rent.html.twig', [
            'rents' => $rents,
        ]);
    }


    /**
     * @Route("/address", name="address")
     */
    public function address(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AddressType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Adresse mis à jour');
        }
        return $this->render('user/address.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
