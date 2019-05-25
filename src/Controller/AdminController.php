<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\AdminPage\AdminCallingType;
use App\Form\AdminPage\AdminStaffType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
	/**
	 * @Route("/admin", name="admin")
	 *
	 * @IsGranted("ROLE_ADMIN")
	 */
	public function admin(Request $request)
	{
		$formStaff = $this->createForm(AdminStaffType::class);
		$formStaff->handleRequest($request);

		if ($formStaff->isSubmitted() && $formStaff->isValid()) {
			return $this->redirectToRoute('admin_staff_edit', [
				'id' => $formStaff->get('staff')->getData()->getId()
			]);
		}

		$formCalling = $this->createForm(AdminCallingType::class);
		$formCalling->handleRequest($request);

		if ($formCalling->isSubmitted() && $formCalling->isValid()) {
			return $this->redirectToRoute('admin_calling_edit', [
				'id' => $formCalling->get('calling')->getData()->getId()
			]);
		}

		return $this->render('admin/admin.html.twig', [
			'formStaff' => $formStaff->createView(),
			'formCalling' => $formCalling->createView()
		]);
	}
}
