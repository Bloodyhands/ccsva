<?php

namespace App\Form;

use App\Entity\Calling;
use App\Form\Collection\StaffCallingType;
use App\Form\Collection\TeamCallingType;
use App\Form\Configuration\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CallingType extends ApplicationType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('teams', CollectionType::class, $this->getConfiguration('', '', [
				'entry_type' => TeamCallingType::class,
				'label' => false
			]))
			->add('competition', ChoiceType::class, $this->getConfiguration('Compétitions', '', [
				'choices' => array(
					'Championnat' => 0,
					'Coupe du Jura' => 1,
					'Coupe du conseil général' => 2,
					'Coupe de Bourgogne-Franche-Comté' => 3,
					'Coupe de France' => 4,
					'Amical' => 5
				)
			]))
			->add('home', ChoiceType::class, $this->getConfiguration('', '', [
				'choices' => array(
					'Domicile' => 1,
					'Extérieur' => 0
				),
				'expanded' => true,
				'multiple' => false,
				'label' => false
			]))
			->add('dateMatch', DateTimeType::class, $this->getConfiguration('Date et heure du match', '', [
				'format' => 'dd-MM-yyyy'
			]))
			->add('place', TextType::class, $this->getConfiguration('Lieu du RDV', ''))
			->add('dateMeet', TimeType::class, $this->getConfiguration('Heure du RDV', ''))
			->add('info', TextareaType::class, $this->getConfiguration('Infos complémentaires', ''))
			->add('staffs', CollectionType::class, $this->getConfiguration('Joueurs', '', [
				'entry_type' => StaffCallingType::class,
				'allow_add' => true,
				'allow_delete' => true
			]));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
								   'data_class' => Calling::class,
							   ]);
	}
}
