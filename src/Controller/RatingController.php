<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Form\RantingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rating", name="rating_")
 */
class RatingController extends AbstractController
{
    /**
     * @Route("/", name="rating")
     */
    public function index(): Response
    {
        $ratings = $this->getDoctrine()
            ->getRepository(Rating::class)
            ->findAll();

        return $this->render('rating/index.html.twig', [
            'ratings' => $ratings,
        ]);
    }

    /**
     * @Route("/newRating", name="newRating")
     * @return Response
     */
    public function newRating(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rating = new Rating();
        $form = $this->createForm(RantingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rating);
            $entityManager->flush();
        }

        return $this->render('product/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
