<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
	/**
	 * Accès à la page connexion
	 *
	 * @Route("/connexion", name="account_connection")
	 *
	 */
	public function connection()
	{
		return $this->render('account/connection.html.twig');
	}

	/**
	 * Permet d'afficher le formulaire d'inscription
	 *
	 * @Route("/inscription", name="account_register")
	 *
	 * @return Response
	 *
	 */
	public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
	{
		$user = new User();

		$form = $this->createForm(RegistrationType::class, $user);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$password = $encoder->encodePassword($user, $user->getPassword());
			$user->setPassword($password);

			$manager->persist($user);
			$manager->flush();

			$this->addFlash(
				'success',
				"Votre compte a bien été créé, vous pouvez maintenant vous connecter !"
			);

			return $this->redirectToRoute('account_connection');
		}

		return $this->render('account/registration.html.twig', [
			'form' => $form->createView()
		]);
	}
}