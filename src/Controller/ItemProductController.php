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
 * @Route("item/product", name="item_product")
 */
class ItemProductController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        return $this->render('item_product/index.html.twig', [
            'controller_name' => 'ItemProductController',
        ]);
    }

    /**
     * @Route("/add/{id}", name="_add")
     */
    public function addProduct(Product $product, EntityManagerInterface $entityManager): Response
    {
        $basket = new Basket();
        $itemProduct = new ItemProduct();
        $itemProduct->setProduct($product);
        $itemProduct->setQuantity(1);
        $itemProduct->setBasket($basket);
        $entityManager->persist($itemProduct);
        $entityManager->persist($basket);
        $entityManager->flush();

        return $this->render('item/index.html.twig', [
            'itemProduct' => $itemProduct,
            'product' => $product,
        ]);
    }
}
