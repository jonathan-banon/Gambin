<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\ItemProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if (is_null($this->getUser()->getBasketOpen())) {
            $basket = new Basket();
            $basket->setUser($this->getUser());
            $basket->setIsOpen(true);
        } else {
            $basket = $this->getUser()->getBasketOpen();
        }
        $itemProduct = new ItemProduct();
        $itemProduct->setProduct($product);
        $itemProduct->setQuantity(1);
        $itemProduct->setBasket($basket);
        $entityManager->persist($itemProduct);
        $entityManager->persist($basket);
        $entityManager->flush();
        $this->addFlash('success', 'produit ajouté au panier ! ');
        return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
    }
}
