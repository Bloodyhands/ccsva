<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	/**
	 * Accès à la page d'accueil
	 *
	 * @Route("/", name="home")
	 */
	public function home()
	{
		return $this->render('/home.html.twig', ['title' => "Bienvenue"]);
	}
}