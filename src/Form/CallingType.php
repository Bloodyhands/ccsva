<?php

namespace App\Form;

use App\Entity\Calling;
use App\Form\Collection\StaffCallingType;
use App\Form\Configuration\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
			->add('teams', ChoiceType::class, $this->getConfiguration('Equipe', '', [

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
			->add('opponent', TextType::class, $this->getConfiguration('Adversaire', ''))
			->add('home', ChoiceType::class, $this->getConfiguration('', '', [
				'choices' => array(
					'Domicile' => 1,
					'Extérieur' => 0
				),
				'expanded' => true,
				'multiple' => false
			]))
            ->add('date', DateType::class, $this->getConfiguration('Date', '', [

			]))
            ->add('hours', TimeType::class, $this->getConfiguration('Heure du Match', '', [

			]))
			->add('place', TextType::class, $this->getConfiguration('Lieu du RDV', ''))
			->add('hoursRdv', TimeType::class, $this->getConfiguration('Heure du RDV', '', [

			]))
			->add('info', TextareaType::class, $this->getConfiguration('Infos complémentaire', ''))
			->add('staffs', CollectionType::class, array(
				'entry_type' => StaffCallingType::class,
				'allow_add' => true,
				'allow_delete' => true
			))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calling::class,
        ]);
    }
}
