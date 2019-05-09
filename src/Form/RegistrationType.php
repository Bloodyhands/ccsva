<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe", "Choisissez votre mot de passe"))
            ->add('name', TextType::class, $this->getConfiguration("Nom", "Votre nom..."))
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('age', IntegerType::class, $this->getConfiguration("Age", ""))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
