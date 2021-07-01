<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Rating;
use App\Entity\Rent;
use App\Entity\User;
use App\Form\ProductType;
use App\Form\RatingType;
use App\Form\RentType;
use App\Repository\ProductRepository;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/catalogue", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/equipement/{slug}", name="show")
     * @return Response
     */
    public function show(
        Product $product,
        ProductRepository $productRepository,
        RatingRepository $ratingRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found.'
            );
        }
        $products = $productRepository->findAll();
        $ratings = $ratingRepository->findBy(['product' => $product, 'isValidated' => true]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'products' => $products,
            'ratings' => $ratings,
        ]);
    }

    /**
     * @Route("/index", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
