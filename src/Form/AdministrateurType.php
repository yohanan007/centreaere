<?php

namespace App\Form;

use App\Entity\Administrateur;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministrateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_administrateur')
            ->add('prenom_administrateur')
            ->add('date_de_naissance_administrateur')
            ->add('telephone')
            ->add('email_administrateur')
            ->add('adresse_administrateur')
            ->add('ville_administrateur')
            ->add('pays_administrateur')
            ->add('users',UserType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Administrateur::class,
        ]);
    }
}
