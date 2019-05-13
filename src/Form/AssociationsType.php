<?php

namespace App\Form;

use App\Entity\Associations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_association')
            ->add('email_association')
            ->add('telephone_association')
            ->add('adresse_association')
            ->add('ville_association')
            ->add('administrateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Associations::class,
        ]);
    }
}
