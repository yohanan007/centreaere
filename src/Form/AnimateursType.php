<?php

namespace App\Form;

use App\Entity\Animateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_animateur')
            ->add('prenom_animateur')
            ->add('DateDeNaissance')
            ->add('administrateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animateurs::class,
        ]);
    }
}
