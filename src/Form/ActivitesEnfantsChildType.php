<?php

namespace App\Form;

use App\Entity\ActivitesEnfants;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ActivitesEnfantsChildType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('enfants');
    $builder->remove('valid');
  }

  public function getParent()
  {
    return ActivitesEnfantsType::class;
  }
}