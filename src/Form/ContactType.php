<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => ' ',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-snrstpjf rounded-pill px-3 py-2',
                    'placeholder' => 'Ingrese su nombre*'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => ' ',
                'required' => false,
                'attr' => [
                    'class' => 'form-control form-snrstpjf rounded-pill px-3 py-2',
                    'placeholder' => 'Ingrese sus apellidos'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => ' ',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-snrstpjf rounded-pill px-3 py-2',
                    'placeholder' => 'Ingrese su correo electrónico*'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => ' ',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-snrstpjf rounded-pill px-3 py-2',
                    'placeholder' => 'Teléfono*'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => ' ',
                'required' => true,
                'attr' => [
                    'class' => 'form-control form-snrstpjf px-3 py-3 rounded-4',
                    'placeholder' => 'Ingrese su mensaje*',
                    'rows' => 5
                ],
            ])
            // ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}