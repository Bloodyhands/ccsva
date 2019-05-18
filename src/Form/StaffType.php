<?php

namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffType extends ApplicationType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class, $this->getConfiguration('Nom', ''))
			->add('firstname', TextType::class, $this->getConfiguration('Prénom', ''))
			->add('email', EmailType::class, $this->getConfiguration('Email', ''))
			->add('birthdate', BirthdayType::class, $this->getConfiguration('Date de naissance', ''))
			->add('position', ChoiceType::class, $this->getConfiguration('Position', '', [
				'choices' => [
					'Entraineur' => 0,
					'Gardien' => 1,
					'Défenseur' => 2,
					'Milieu' => 3,
					'Attaquant' => 4
				]
			])
		);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
								   'data_class' => Staff::class,
							   ]);
	}
}
