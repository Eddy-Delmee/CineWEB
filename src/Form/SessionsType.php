<?php

namespace App\Form;

use App\Entity\Sessions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('monthMovie')
            ->add('hourMovie')
            ->add('dayMovie')
            ->add('idHall')
            ->add('idMovie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sessions::class,
        ]);
    }
}
