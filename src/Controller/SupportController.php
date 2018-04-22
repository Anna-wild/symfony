<?php

namespace App\Controller;

use App\Mailer\Emailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SupportController extends Controller
{
    /**
     * @Route("/support", name="support")
     */
    public function index(Emailer $emailer)
    {

        return $this->render('support/index.html.twig', [
            'controller_name' => 'SupportController',
        ]);
    }
}
