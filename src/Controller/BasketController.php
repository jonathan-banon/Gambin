<?php

namespace App\Controller;

use App\Entity\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/basket", name="basket_")
 */
class BasketController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $basket = $this->getDoctrine()
            ->getRepository(Basket::class)
            ->findAll();

        return $this->render('basket/index.html.twig', [
            'basket' => $basket,
        ]);
    }
}
