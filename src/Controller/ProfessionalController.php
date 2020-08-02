<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalController extends AbstractController
{
    /**
     * @Route("/professional", name="professional_index")
     */
    public function index()
    {
        return $this->render('professional/index.html.twig', [
            'controller_name' => 'ProfessionalController',
        ]);
    }
}
