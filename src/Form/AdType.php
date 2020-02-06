<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Titre',
                'attr'=> [
                    'placeholder'=> 'Tapez un super titre pour votre annonce'
                ]
            ])
            ->add('slug', TextType::class,[
                'label' => 'Chaine URL',
                'attr' => [
                    'placeholder' => "lien web de l'annonce (automatique)"
                ]
            ])
            ->add('price')
            ->add('introduction')
            ->add('content')
            ->add('coverImage')
            ->add('rooms')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
