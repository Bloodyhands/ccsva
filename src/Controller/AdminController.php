<?php

namespace App\Controller;

use App\Form\AdminPage\AdminStaffType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
	/**
	 * @Route("/admin", name="admin")
	 */
	public function admin(Request $request)
	{
		$form = $this->createForm(AdminStaffType::class);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			return $this->redirectToRoute('admin_staff_edit', [
				'id' => $form->get('staff')->getData()->getId()
			]);
		}
		return $this->render('admin/admin.html.twig', [
			'form' => $form->createView()
		]);
	}
}
