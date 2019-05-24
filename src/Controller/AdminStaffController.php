<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\StaffType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStaffController extends AbstractController
{
	/**
	 * Permet l'ajout de joueurs et encadrants
	 *
	 * @Route("/admin/staff/new", name="admin_staff_new")
	 *
	 * @return Response
	 */
	public function createStaff(Request $request, ObjectManager $manager)
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
	 * Permet d'afficher le formulaire d'édition des joueurs et encadrants
	 *
	 * @Route("/admin/staff/{id}/edit", name="admin_staff_edit")
	 *
	 * @param Staff $staff
	 * @return Response
	 */
	public function updateStaff(Staff $staff, Request $request, ObjectManager $manager)
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
			return $this->redirectToRoute('admin');
		}
		return $this->render('admin/staff/edit.html.twig', [
			'staff' => $staff,
			'form' => $form->createView()
		]);
	}

	/**
	 * Permet de supprimer des joueurs en encadrants
	 *
	 * @Route("/admin/staff/{id}/delete", name="admin_staff_delete")
	 *
	 * @param Staff $staff
	 * @param ObjectManager $manager
	 * @return Response
	 */
	public function deleteStaff(Staff $staff, ObjectManager $manager)
	{
		$manager->remove($staff);
		$manager->flush();

		$this->addFlash(
			'success',
			"Le joueur ou encadrant {$staff->getName()} a bien été supprimé"
		);

		return $this->redirectToRoute('admin');
	}
}