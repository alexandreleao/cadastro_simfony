<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    public function numero(): Response
    {
        $numero = random_int(0,100);

        return $this->render('numero.html.twig', [
            'numero' => $numero,
        ]);
    }
}