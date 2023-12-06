<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', TextType::class, [
                'label' => 'Amount',
            ])
            ->add('currencyFrom', ChoiceType::class, [
                'label' => 'Currency From',
                'choices' => array_flip($options['currencies']),
            ])
            ->add('currencyTo', ChoiceType::class, [
                'label' => 'Currency To',
                'choices' => array_flip($options['currencies']),
            ])
            ->add('convert', SubmitType::class, [
                'label' => 'Convert',
            ]);
            // ->add('convertInverse', SubmitType::class, [ // Nuevo botón para la conversión inversa
            //     'label' => 'Convert Inverse',
            // ])
            // ->add('currencyToInverse', ChoiceType::class, [
            //     'label' => 'Currency To Inverse',
            //     'choices' => $options['currencies'],
            // ])
            
            // ->add('convertInverse', SubmitType::class, [
            //     'label' => 'Convert Inverse',
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'currencies' => [],
        ]);
    }
}