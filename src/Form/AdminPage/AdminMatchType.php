<?php

namespace App\Form\AdminPage;

use App\Entity\Match;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminMatchType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('calling', EntityType::class, [
				'class' => Match::class,
				'choice_label' => function ($match) {
					return 'Match du'.' '.$match->getDate();
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
								   'data_class' => Match::class,
							   ]);
	}
}