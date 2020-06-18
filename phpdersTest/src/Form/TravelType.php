<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Travel;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('image',FileType::class, [
                'label' => 'Travel Main Image',

                'mapped' => false,

                'required' => false,


                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/*',
                ],
                'mimeTypesMessage' => 'Please upload a valid Image File',
                     ])
                ],
            ])

            ->add('star', ChoiceType::class, [
                'choices' => [
                    '1 Star' => '1',
                    '2 Star' => '2',
                    '3 Star' => '3',
                    '4 Star' => '4',
                    '5 Star' => '5',
                ],
            ])

        ->add('address')
        ->add('phone')

        ->add('city', ChoiceType::class, [
            'choices' => [
                'Ankara' => 'Ankara',
                'Konya' => 'Konya',
                'Istanbul' => 'Istanbul',
                'Paris' => 'Paris',
                'Karaman' => 'Karaman',
                'Isparta' => 'Isparta',
                'Moscow' => 'Moscow',
                'New York' => 'New York',
                'Barcelona' => 'Barcelona'],
        ])

        ->add('country', ChoiceType::class, [
            'choices' =>  [
                 'Turkiye' => 'Turkiye',
                'Spain' => 'Spain',
                'Greece' => 'Greece',
                'Russia' => 'Russia',
                'ABD' => 'ABD',
                'France' => 'France'],
        ])
        ->add('detail', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))

        ->add('status', ChoiceType::class, [
            'choices' => [
                'True' => 'True',
                'False' => 'False'],
        ])

        ->add('category',EntityType::class,[
            'class'=>Category::class,
            'choice_label'=>'title',
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Travel::class,
        ]);
    }
}
