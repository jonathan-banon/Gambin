<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\ItemProduct;
use App\Entity\Product;
use App\Entity\Rent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("item/product", name="item_product_")
 */
class ItemProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('item_product/index.html.twig', [
            'controller_name' => 'ItemProductController',
        ]);
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function addProduct(Product $product, EntityManagerInterface $entityManager): Response
    {
        if (is_null($this->getUser()->getBasketOpen())) {
            $basket = new Basket();
            $basket->setUser($this->getUser());
            $basket->setIsOpen(true);
        }

        $basket = $this->getUser()->getBasketOpen();
        $itemProduct = new ItemProduct();
        $itemProduct->setProduct($product);
        $itemProduct->setQuantity(1);
        $itemProduct->setBasket($basket);
        $entityManager->persist($itemProduct);
        $entityManager->persist($basket);
        $entityManager->flush();

        return $this->render('basket/index.html.twig', [
            'itemProduct' => $itemProduct,
            'product' => $product,
        ]);
    }
}
