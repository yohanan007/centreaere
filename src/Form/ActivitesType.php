<?php

namespace App\Form;



use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\Activites;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Associations;
use App\Entity\journaliers;
use App\Entity\TypeActivites;
use App\Form\JournaliersType;
use App\Repository\AssociationsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityRepository;

class ActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
        $id = $options['user'];

        $builder
            ->add('nom_activite')
            ->add('typeactivites', EntityType::class,
            [
                'class' => TypeActivites::class,
                'choice_label' => 'nom_type',
                'required'=>true,
            ])
            ->add('associations', EntityType::class,
             [
                 'class'=> Associations::class , 
                 'query_builder' => function (EntityRepository $er) use($id) {
                return $er->createQueryBuilder('a')
                //->select('a.nom_association')
                ->join('a.administrateurs','ad')
                ->where('ad.users = :val')
                ->setParameter('val',$id)
                    ->orderBy('a.nom_association', 'ASC');
            },
             'choice_label'=> 'nom_association',])
           // ->add('administrateurs')

            ->add('journaliers',CollectionType::class,
                                        ['entry_type'=>JournaliersType::class,
                                        'allow_add' => true,
                                        'prototype'=>true,
                                        'label'=>' ',
                                        ])
            ->add('evenementiels',CollectionType::class,
            ['entry_type'=>EvenementielsType::class,
            'allow_add' => true,
            'prototype'=>true,
            'label'=>' ',
                                        ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activites::class,
            'user'=>array(),
        ]);
    }
}
