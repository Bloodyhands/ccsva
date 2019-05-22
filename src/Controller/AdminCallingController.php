<?php

namespace App\Controller;

use App\Entity\Calling;
use App\Entity\Staff;
use App\Form\CallingType;
use App\Service\SendEmail;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCallingController extends AbstractController
{
	/**
	 * Permet la création de nouvelle convocation
	 *
	 * @Route("/admin/convocation/new", name="admin_calling_new")
	 *
	 * @param Request $request
	 * @param ObjectManager $manager
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 * @throws \Exception
	 */
	public function newCalling(Request $request, ObjectManager $manager, SendEmail $sendEmail)
	{
		$calling = new Calling();
		$createdAt = new DateTime();
		$staff = new Staff();

		$form = $this->createForm(CallingType::class, $calling);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){

			foreach ($calling->getStaffs() as $staff) {
				$staff->setCalling($calling);
				$calling->addTicket($staff);
				$calling->getCreatedAt($createdAt);
				$manager->persist($staff);
			}
			$manager->persist($calling);
			$manager->flush();

			return $this->redirectToRoute('admin');
		}
		$sendEmail->mail($calling, $staff);

		return $this->render('admin/calling/new.html.twig', array(
			'form' => $form->createView(),
		));
	}
}