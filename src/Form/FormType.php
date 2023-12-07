<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Please enter an amount.']),
                ],
            ])
            ->add('currencyFrom', ChoiceType::class, [
                'choices' => $options['currencies'],
                'constraints' => [
                    new NotBlank(['message' => 'Please select the currency from.']),
                ],
            ])
            ->add('currencyTo', ChoiceType::class, [
                'choices' => $options['currencies'],
                'constraints' => [
                    new NotBlank(['message' => 'Please select the currency to.']),
                ],
            ])
            ->add('convert', SubmitType::class);
    


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