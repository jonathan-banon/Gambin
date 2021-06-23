<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/stock", name="stock")
     */
    public function stock(StockRepository $stockRepository): Response
    {
        return $this->render('admin/stockManager.html.twig', [
            'stocks' => $stockRepository->findAll(),
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
}
