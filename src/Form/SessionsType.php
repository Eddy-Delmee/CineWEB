<?php

namespace App\Form;

use App\Entity\Halls;
use App\Entity\Movies;
use App\Entity\Sessions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SessionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateSession', DateTimeType::class, [
                'widget' => 'single_text',
                'date_label' => 'Starts On',
            ])
            // ->add('idHall')
            ->add('idHall', EntityType::class, [
                'class' => Halls::class,
                'choice_label' => 'nameHall',
            ])
            // ->add('idMovie')
            ->add('idMovie', EntityType::class, [
                'class' => Movies::class,
                'choice_label' => 'titleMovie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sessions::class,
        ]);
    }
}
