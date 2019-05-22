<?php

namespace App\Controller;

use App\Entity\Staff;
use App\Form\AdminPage\AdminStaffType;
use App\Repository\StaffRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
	/**
	 * @Route("/admin", name="admin")
	 */
	public function admin(StaffRepository $repo, ObjectManager $manager, Request $request)
	{
		$staffs = $repo->findAll();
		$form = $this->createForm(AdminStaffType::class, $staffs);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$manager->persist($staffs);
			$manager->flush();
		}
		return $this->render('admin/admin.html.twig', [
			'staffs' => $staffs
		]);
	}

	/**
	 * @Route("/admin/gestionDesEquipes", name="admin_team")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function adminTeam()
	{
		return $this->render('admin/player.html.twig');
	}

	/**
	 * @Route("/admin/gestionDesMatchs", name="admin_match")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function adminMatch()
	{
		return $this->render('admin/player.html.twig');
	}

	/**
	 * @Route("/admin/gestionDesPhotos", name="admin_photo")
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function adminPhoto()
	{
		return $this->render('admin/player.html.twig');
	}
}
