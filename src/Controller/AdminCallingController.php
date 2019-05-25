<?php

namespace App\Controller;

use App\Entity\Calling;
use App\Entity\Staff;
use App\Entity\Team;
use App\Form\CallingType;
use App\Service\SendEmail;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
	 * @IsGranted("ROLE_ADMIN")
	 *
	 * @param Request $request
	 * @param ObjectManager $manager
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
	 * @throws \Exception
	 */
	public function newCalling(Request $request, ObjectManager $manager/*, SendEmail $sendEmail*/)
	{
		$calling = new Calling();
		$team = new Team();
		$calling->addTeam($team);
		$team2 = new Team();
		$calling->addTeam($team2);

		$form = $this->createForm(CallingType::class, $calling);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			foreach ($calling->getStaffs() as $staff) {
				$staff->setCallings($calling);
				$manager->persist($staff);
			}
			$manager->persist($calling);
			$manager->flush();

			$this->addFlash(
				'success',
				"La convocation a bien été envoyée"
			);

			return $this->redirectToRoute('admin');
		}
		//$sendEmail->mail($calling, $staff);

		return $this->render('admin/calling/new.html.twig', array(
			'form' => $form->createView()
		));
	}
}