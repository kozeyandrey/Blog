<?php

namespace GeekHub\GuestBookBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreatePostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text')
            ->add('Email', 'email')
            ->add('Content', 'textarea')
            ->add('submit', 'submit');


    }

    public function getName()
    {
        return 'createPost';
    }
} 