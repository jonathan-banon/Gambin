<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Entity\Rent;
use App\Entity\Status;
use App\Form\AddressType;
use App\Form\RentType;
use App\Service\Price;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rent", name="rent_")
 */

class RentController extends AbstractController
{
    /**
     * @Route("/rent", name="rent")
     */
    public function index(): Response
    {
        return $this->render('rent/index.html.twig', [
            'controller_name' => 'RentController',
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rent = new Rent();
        $status = new Status();
        $status->setName('TEST');
        $rent->setStatus($status);
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rent);
            $entityManager->persist($status);
            $entityManager->flush();
            $this->addFlash('success', 'Location prise en compte');
        }

        $basket = $this->getUser()->getBasketOpen();


        return $this->render('rent/new.html.twig', [
            'form' => $form->createView(),
            'basket' => $basket,
        ]);
    }

    /**
     * @Route("/adress", name="adress")
     * @return Response
     */
    public function adress(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AddressType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Adresse mis à jour');
        }
        return $this->render('rent/adress.html.twig', [
            'controller_name' => 'RentController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/payment", name="payment")
     * @return Response
     */
    public function payment(Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('rent/payment.html.twig', [
            'controller_name' => 'RentController',
        ]);
    }
    /**
     * @Route("/sucess", name="sucess")
     * @return Response
     */
    public function sucess(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser()->getFirstName();
        return $this->render('rent/sucess.html.twig', [
            'controller_name' => 'RentController',
            'name' => $user
        ]);
    }
}
