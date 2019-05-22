<?php

namespace App\Form\AdminPage;

use App\Entity\Staff;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminStaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('staff', EntityType::class, [
            	'class' => Staff::class,
				'choice_label' => 'name',
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
