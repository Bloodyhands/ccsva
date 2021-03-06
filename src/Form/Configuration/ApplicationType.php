<?php

namespace App\Form\Configuration;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
	/**
	 * Permet d'avoir la configuration de base d'un champ de formulaire
	 *
	 * @param $label
	 * @param $placeholder
	 * @param array $options
	 * @return array
	 */
	protected function getConfiguration($label, $placeholder, $options = [])
	{
		return array_merge([
							   'label' => $label,
							   'attr' => [
								   'placeholder' => $placeholder
							   ]
						   ], $options);
	}
}