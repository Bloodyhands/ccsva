<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStaffController extends AbstractController
{
	/**
	 * Permet l'ajout de joueurs et encadrements
	 *
	 * @Route("/admin/staff/new", name="admin_staff_new")
	 *
	 * @return Response
	 */
	public function adminAddStaff(Request $request, ObjectManager $manager)
	{
		$staff = new Staff();
		$form = $this->createForm(StaffType::class, $staff);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$manager->persist($staff);
			$manager->flush();

			$this->addFlash(
				'success',
				"La fiche du joueur a bien été créée"
			);

			return $this->redirectToRoute('admin');
		}

		return $this->render('admin/staff/new.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * Permet d'afficher le formulaire d'édition des joueurs et encadrements
	 *
	 * @Route("/admin/staff/{id}/edit", name="admin_staff_edit")
	 *
	 * @param Staff $staff
	 * @return Response
	 */
	public function adminEditStaff(Staff $staff, Request $request, ObjectManager $manager)
	{
		$form = $this->createForm(StaffType::class, $staff);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$manager->persist($staff);
			$manager->flush();

			$this->addFlash(
				'success',
				'La modification a bien été effectuée'
			);
		}

		return $this->render('admin/staff/edit.html.twig', [
			'staff' => $staff,
			'form' => $form->createView()
		]);
	}
}