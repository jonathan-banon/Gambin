<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Rent;
use App\Form\RentType;
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
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rent);
            $entityManager->flush();
        }
        return $this->render('rent/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
