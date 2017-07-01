<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

/**
 * Class RegisterType
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'This value is too short !',
                        'max' => 150,
                        'maxMessage' => 'This value is too long !'
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'This value is too short !',
                        'max' => 150,
                        'maxMessage' => 'This value is too long !'
                    ])
                ]
            ])
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'This value is too short !',
                        'max' => 75,
                        'maxMessage' => 'This value is too long !'
                    ])
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
