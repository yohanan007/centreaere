<?php

namespace App\Form;

use App\Entity\Journaliers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class JournaliersType extends AbstractType
{

    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_de_debut_journalier')
            ->add('date_fin_journalier')
            ->add('option_journalier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Journaliers::class,
        ]);
    }
}
