<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Title',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'The title cannot be empty.']),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter post title',
                ],
            ])
            ->add('content', null, [
                'label' => 'Content',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'The content cannot be empty.']),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Write your post content here...',
                    'rows' => 8,
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image (JPG, PNG, WebP)',
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPG, PNG, WebP, GIF)',
                    ])
                ],
            ])
            ->add('Send', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
