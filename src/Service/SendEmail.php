<?php

namespace App\Service;

use App\Entity\Calling;
use App\Entity\Staff;
use Swift_Mailer;
use Twig_Environment;

class SendEmail
{
	private $mail;
	private $template;

	public function __construct(Swift_Mailer $mailer, Twig_Environment $templating)
	{
		$this->mail = $mailer;
		$this->template = $templating;
	}

	/**
	 * Envoi d'un email de convocation aux joueurs
	 *
	 * @param Calling $calling
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function mail(Calling $calling, Staff $staff)
	{
		$message = (new \Swift_Message('Convocation pour le match du'.' '.$calling->getDateMatch()))
			->setFrom('mathieu_franon@outlook.fr')
			->setTo($staff->getEmail())
			->setBody(
				$this->template->render(
					'emails/email.html.twig',
					['calling' => $calling]
				),
				'text/html'
			);

		$this->mail->send($message);
	}
}