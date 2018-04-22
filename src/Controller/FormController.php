<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if (!$form->isSubmitted())
            $this->addFlash("info","hello");

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom($data['email'])
                ->setTo('26ann03@gmail.cpm')
                ->setBody(
                    $data['message'],
                    'text/plain'
                );
            $mailer->send($message);
            $this->addFlash("success","send");
            return $this->redirectToRoute("form");//перенаправляє на якусь юрл

            dump($data);
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'myForm' => $form->createView()
        ]);
    }

}
