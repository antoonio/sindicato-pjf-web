<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\ContactType;
use App\Entity\Contact;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    #[Route('/about-us', name: 'app_about_us')]
    public function aboutUs()
    {
        return $this->render('main/about_us.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/benefits', name: 'app_benefits')]
    public function benefits()
    {
        return $this->render('main/benefits.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events()
    {
        return $this->render('main/events.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $email = (new Email())
                ->from('duloposmx@gmail.com')
                ->replyTo($task->getEmail())
                ->to('duloposmx@gmail.com')
                ->subject('Contacto | renovacionsindicalcjf.com')
                ->text("Nuevo mensaje:\nNombre: {$task->getName()}\nApellidos: {$task->getLastname()}\nCorreo electrónico: {$task->getEmail()}\nTeléfono: {$task->getPhone()}\nMensaje: {$task->getMessage()}")
            ;

            $mailer->send($email);

            $this->addFlash('success', 'Tu mensaje ha sido enviado exitosamente.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('main/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/our-app', name: 'app_our_app')]
    public function ourApp()
    {
        return $this->render('main/our_app.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
