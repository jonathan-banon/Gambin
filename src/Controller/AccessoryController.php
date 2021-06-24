<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\Image;
use App\Form\AccessoryType;
use App\Form\PictureType;
use App\Repository\AccessoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessoryController extends AbstractController
{

    /**
     * @Route("/catalogue/accessoires", name="accessory_index")
     * @return Response
     */
    public function index(AccessoryRepository $accessoryRepository): Response
    {
        return $this->render('accessory/index.html.twig', [
            'accessories' => $accessoryRepository->findAll(),
        ]);
    }
}
