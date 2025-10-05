<?php
// src/Form/RegistrationFormType.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'register.form.email.label',
                'invalid_message' => 'form.email.mismatch',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'register.form.name.label',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'form.name.required']),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'form.name.min',
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'register.form.password.mismatch',
                'first_options' => [
                    'label' => 'register.form.password.label',
                    'attr' => ['autocomplete' => 'new-password'],
                ],
                'second_options' => [
                    'label' => 'register.form.password.confirm',
                    'attr' => ['autocomplete' => 'new-password'],
                ],
                'constraints' => [
                    new NotBlank(['message' => 'register.form.password.required']),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'register.form.password.min',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'register.form.terms.label',
                'mapped' => false,
                'constraints' => [
                    new IsTrue(['message' => 'form.terms.required']),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'register.form.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'auth',
        ]);
    }
}
