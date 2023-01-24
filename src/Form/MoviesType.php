<?php

namespace App\Form;

use App\Entity\Movies;
use App\Entity\Categories;
use App\Entity\Recommendations;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleMovie')
            ->add('director')
            ->add('producer')
            ->add('actors')
            ->add('timeMovie')
            ->add('yearMovie')

            // ->add('imageMovie')
            ->add('imageMovie', FileType::class, [
                'label' => 'Image du film',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                new File([
                'maxSize' => '5000k',
                'mimeTypes' => [
                'image/*',
                ],
                'mimeTypesMessage' => 'Image trop lourde',
                ])
                ],
                ])
                
            ->add('videoMovie')
            ->add('shortDesciptionMovie')
            ->add('descriptionMovie', CKEditorType::class)
            // ->add('idCategory')
            ->add('idCategory', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'nameCategory',
            ])
            // ->add('idRecommendation')
            ->add('idRecommendation', EntityType::class, [
                'class' => Recommendations::class,
                'choice_label' => 'forbiddenAge',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}