<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( ProductRepository $productrepo): Response
    {
        $product = new Product();
        $product->setName('Poussette Yoyocc ');
        $product->setIdentifier('Yoyocc ');
        $product->setDescription('Lorem ipsum in dolor Lorem ipsum in dolor Lorem ipsum in dolor ');
        $product->setStorage('Bordeaux ');
        $product->setPrice(1000.50);
        $product->setTarget(4);
        $product->setMarque('Babyzencc');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();
        dd($product);


        return $this->render('home/index.html.twig');
    }
}
