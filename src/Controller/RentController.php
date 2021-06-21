<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Rent;
use App\Entity\Status;
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
        return $this->render('rent/new.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
