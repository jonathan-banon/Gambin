<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\Image;
use App\Form\AccessoryType;
use App\Form\PictureType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accessory", name="accessory_")
 */
class AccessoryController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accessory = new Accessory();
        $form = $this->createForm(AccessoryType::class, $accessory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accessory);
            $entityManager->flush();
        }

        return $this->render('accessory/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
