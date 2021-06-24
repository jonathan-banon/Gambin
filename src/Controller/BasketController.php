<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\ItemProduct;
use App\Service\Price;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $basket = $this->getUser()->getBasketOpen();
        return $this->render('basket/index.html.twig', [
            'basket' => $basket,
        ]);
    }

    /**
     * @Route("/deleteBasket/{id}", name="deleteBasket")
     */
    public function delete(Basket $basket, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($basket);
            $entityManager->flush();

        return $this->redirectToRoute('basket_index');
    }

    /**
     * @Route("/deleteItem/{id}", name="deleteItem")
     */
    public function deleteItemProduct(ItemProduct $itemProduct, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($itemProduct);
            $entityManager->flush();

        return $this->redirectToRoute('basket_index');
    }
}
