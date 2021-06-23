<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\Product;
use App\Form\AccessoryType;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/product/new", name="new_product")
     * @return Response
     */
    public function newProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('admin/product_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/accessory/new", name="new_accessory")
     */
    public function newAccessory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accessory = new Accessory();
        $form = $this->createForm(AccessoryType::class, $accessory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accessory);
            $entityManager->flush();
        }

        return $this->render('admin/accessory_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
