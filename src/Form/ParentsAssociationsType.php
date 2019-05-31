<?php

namespace App\Form;

use App\Entity\ParentsAssociations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Associations;
use App\Form\ParentsType;
use Doctrine\ORM\EntityRepository;

class ParentsAssociationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['user'];

        $builder
            ->add('parents', ParentsType::class)
            ->add('associations', EntityType::class,
            ['class'=>Associations::class,
             'choice_label'=>'nom_association',
             'query_builder' => function (EntityRepository $er) use($id) {
                return $er->createQueryBuilder('a')
                //->select('a.nom_association')
                ->join('a.administrateurs','ad')
                ->where('ad.users = :val')
                ->setParameter('val',$id)
                    ->orderBy('a.nom_association', 'ASC');
            },
            'required'=>true])
            ->add('valid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ParentsAssociations::class,
            'user'=>array(),
        ]);
    }
}
