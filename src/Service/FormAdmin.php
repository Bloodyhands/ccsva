<?php

namespace App\Service;

use App\Form\AdminPage\AdminStaffType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormAdmin
{
	public function formStaff(Request $request)
	{
		/*$form = $this->createForm(AdminStaffType::class);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			return $this->redirectToRoute('admin_staff_edit', [
				'id' => $form->get('staff')->getData()->getId()
			]);
		}*/
	}

	public function formCalling()
	{

	}
}