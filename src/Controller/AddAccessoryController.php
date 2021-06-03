<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddAccessoryController extends AbstractController
{
    /**
     * @Route("/add/accessory", name="add_accessory")
     */
    public function index(): Response
    {
        return $this->render('add_accessory/index.html.twig', [
            'controller_name' => 'AddAccessoryController',
        ]);
    }
}
