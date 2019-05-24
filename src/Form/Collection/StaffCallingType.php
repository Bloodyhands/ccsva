<?php

namespace App\Form\Collection;

use App\Entity\Staff;
use App\Form\Configuration\ApplicationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffCallingType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('staff', EntityType::class, [
				'class' => Staff::class,
				'choice_label' => function ($staff) {
					return $staff->getFirstname().' '.$staff->getName();
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
            'data_class' => Staff::class,
        ]);
    }
}
