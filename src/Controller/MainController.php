<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/about-us", name="app_about_us")
     */
    public function aboutUs()
    {
        return $this->render('main/about_us.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/benefits", name="app_benefits")
     */
    public function benefits()
    {
        return $this->render('main/benefits.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/events", name="app_events")
     */
    public function events()
    {
        return $this->render('main/events.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact()
    {
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/our-app", name="app_our_app")
     */
    public function ourApp()
    {
        return $this->render('main/our_app.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
