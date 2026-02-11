<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = isset($options['data']) && $options['data']->getId();

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter email address',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Email cannot be empty']),
                    new Assert\Email(['message' => 'Invalid email format']),
                ],
            ])
            ->add('fullName', TextType::class, [
                'label' => 'Full Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter full name',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Full name cannot be empty']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Full name must be at least 2 characters',
                        'maxMessage' => 'Full name must not exceed 255 characters',
                    ]),
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone Number',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter phone number (optional)',
                ],
                'constraints' => [
                    new Assert\Length([
                        'max' => 20,
                        'maxMessage' => 'Phone must not exceed 20 characters',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[\d\+\-\(\)\s]*$/',
                        'message' => 'Invalid phone number format',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => $isEdit ? 'Password (leave blank to keep current)' : 'Password',
                'required' => !$isEdit,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter password',
                ],
                'constraints' => !$isEdit ? [
                    new Assert\NotBlank(['message' => 'Password cannot be empty']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Password must be at least 6 characters',
                    ]),
                ] : [],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
