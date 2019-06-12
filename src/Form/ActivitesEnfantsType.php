<?php

namespace App\Form;

use App\Entity\ActivitesEnfants;
use App\Entity\Activites;
use App\Entity\JourActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;

class ActivitesEnfantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['utilisateur_id'];
        $builder
            //->add('valid')
            ->add('enfants')
            // géneration des activités lié à l'utilisateur par son appartennace à des associations
            ->add('activites',
            EntityType::class,
            [
                'class' => Activites::class,
                'query_builder'=>function (EntityRepository $er) use($id) {
                    return $er->createQueryBuilder('a')
                    ->join('a.associations','ass')
                    ->addSelect('ass')
                    ->join('ass.parentsAssociations','pass')
                    ->addSelect('pass')
                    ->join('pass.parents','par')
                    ->addSelect('par')
                    ->andWhere('par.utilisateur = :var')
                    ->setParameter('var',$id)
                        ;
                },

  
             'choice_label' => 'nom_activite',
            ]
            )
        ;

        $formModifier = function (FormInterface $form, Activites $activite = null) {
            $positions = null === $activite ? [] : $activite;

            $form->add('jours', EntityType::class, [
                'class' => JourActivite::class,
                'placeholder' => '',
                'expanded'=>true,
                'multiple'=>true,
                'required'=>true,
                'query_builder' => function (EntityRepository $er) use($positions) {
                    return $er->createQueryBuilder('ja')
                                ->andWhere('ja.activites = :var')
                                ->setParameter('var',$positions)                     
                        ;                
                    },
            ]);
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
                
            $data = $event->getData();

            $formModifier($event->getForm(), $data->getActivites());
            
        });


        
        $builder->get('activites')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $sport);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActivitesEnfants::class,
            'utilisateur_id'=>array(),
        ]);
    }
}
