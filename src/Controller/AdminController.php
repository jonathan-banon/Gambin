<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\Product;
use App\Entity\Rating;
use App\Form\AccessoryType;
use App\Form\ProductType;
use App\Repository\RatingRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Stock;
use App\Repository\StockRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/administration", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/stock", name="stock")
     */
    public function stock(StockRepository $stockRepository): Response
    {
        return $this->render('admin/stockManager.html.twig', [
            'stocks' => $stockRepository->findAll()
        ]);
    }

    /**
     * @Route("/equipement/ajout", name="new_product")
     * @return Response
     */
    public function newProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $slugify = new Slugify();
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setSlug($slugify->slugify($product->getName()));
            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('admin/product_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/stock/{stock}", name="stock_available")
     */
    public function changeDispo(EntityManagerInterface $manager, Stock $stock, MailerInterface $mailer): Response
    {
        //TODO SI CEST UN PRODUIT TU CHECK SI POUR LE PRODUIT ASSOCIE, SI RIEN EST DISPO
        // DANS LE CAS OU RIEN NETAIS DISPO
        // TU ENVOIE UN MAIL A TOUS LES USER QUI L'AVAIS EN FAVORI
        $isAvailable = true;
        $stock->setIsAvailable(!$stock->getIsAvailable());
        foreach ($stock->getProduct()->getUsers() as $user) {
            $usersEmail[] = $user->getEmail();
        }
        $manager->persist($stock);
        $manager->flush();
        if ($stock->getIsAvailable() === $isAvailable) {
            foreach ($usersEmail as $userEmail) {
                $email = (new Email())
                    ->from($this->getParameter('mailer_from'))
                    ->to($userEmail)
                    ->subject('La disponibilité du produit vient de changer')
                    ->html('<p>La disponibilité du produit vient de changer</p>');
                $mailer->send($email);
            }
        }

        return $this->redirectToRoute('admin_stock');
    }

    /**
     * @Route("/accessoroire/ajout", name="new_accessory")
     */
    public function newAccessory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $slugify = new Slugify();
        $accessory = new Accessory();
        $form = $this->createForm(AccessoryType::class, $accessory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $accessory->setSlug($slugify->slugify($accessory->getName()));
            $entityManager->persist($accessory);
            $entityManager->flush();
        }

        return $this->render('admin/accessory_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/commentaires", name="comment")
     */
    public function comment(RatingRepository $ratingRepository): Response
    {
        $comments = $ratingRepository->findBy(['isValidated' => false]);
        return $this->render('admin/comment.html.twig', [
            'comments' => $comments,
            ]);
    }

    /**
     * @Route ("/commentaires/{id}", name="comment_delete", methods={"POST"})
     */
    public function commentDelete(Rating $rating, Request $request, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rating->getId(), $request->request->get('_token'))) {
            $manager->remove($rating);
            $manager->flush();
            $this->addFlash('danger', 'Le commentaire a été supprimé');
            return $this->redirectToRoute('admin_comment');
        }
    }

    /**
     * @Route ("/commentaires/{id}", name="comment_authorized", methods={"GET"})
     */
    public function commentAuthorized(Rating $rating, Request $request, EntityManagerInterface $manager): Response
    {
            $rating->setIsValidated(true);
            $manager->flush();
            $this->addFlash('success', 'Commentaire ajouté à la plateforme !');
            return $this->redirectToRoute('admin_comment');
    }
}
