<?php

namespace App\Form;

use App\Entity\Enfants;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_enfant')
            ->add('prenom_enfant')
            ->add('date_de_naissance_enfant')
            ->add('user',UserType::class,['label'=>'COMPTE POUR VOTRE ENFANT'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enfants::class,
        ]);
    }
}
