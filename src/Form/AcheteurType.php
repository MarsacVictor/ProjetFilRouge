<?php

namespace App\Form;

use App\Entity\Acheteur;
use App\Entity\Realisation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcheteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('mail')
            ->add('realisation', EntityType::class, ['class' => Realisation::class, "choice_label"=>'nom', 'required' =>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acheteur::class,
        ]);
    }
}
