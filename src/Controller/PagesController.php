<?php

namespace App\Controller;

use App\Entity\Staff;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
	/**
	 * Accès à la page d'accueil
	 *
	 * @Route("/", name="home")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function home()
	{
		return $this->render('/home.html.twig', ['title' => "Bienvenue"]);
	}

	/**
	 * Accès à la page des joueurs
	 *
	 * @Route("/staff", name="staff")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function staff()
	{
		$staff = new Staff();

		return $this->render('/staff.html.twig', [
			'staff' => $staff
		]);
	}
}