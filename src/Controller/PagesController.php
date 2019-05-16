<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
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

	/**
	 * Accès à la page photos
	 *
	 * @Route("/photo", name="photo")
	 */
	public function photo()
	{
		return $this->render('/photo.html.twig');
	}
}