<?php

namespace App\Form;

use App\Entity\Parents;
use App\Entity\User;
use App\Form\UserType;
use App\Form\ParentsAssociations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ParentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_parent')
            ->add('prenom_parent')
            ->add('utilisateur',UserType::class)
          //  ->add('enfants')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parents::class,
        ]);
    }
}
