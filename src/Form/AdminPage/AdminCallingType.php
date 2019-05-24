<?php

namespace App\Form\AdminPage;

use App\Entity\Calling;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminCallingType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('calling', EntityType::class, [
				'class' => Calling::class,
				'choice_label' => function ($calling) {
					return 'Convocation du'.' '.$calling->getCreatedAt();
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
								   'data_class' => Calling::class,
							   ]);
	}
}