<?php

namespace App\Form\Collection;

use App\Entity\Team;
use App\Form\Configuration\ApplicationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamCallingType extends ApplicationType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('team', EntityType::class, [
				'class' => Team::class,
				'choice_label' => function ($team) {
					return $team->getName();
				},
				'expanded' => false,
				'multiple' => false,
				'label' => false,
				'mapped' => false
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
								   'data_class' => Team::class,
							   ]);
	}
}
