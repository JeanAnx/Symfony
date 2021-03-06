<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('job' ,  ChoiceType::class, [
                'choices' => Author::getJobChoices(),
                'choice_label' => function ($choiceValue, $key, $value) {
                    return "author.new.job_choices.$value";
                },
            ])
            ->add('birth' , null , [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
            // Pour "traduire" les Labels du Form, on utilise cette ligne dans les params par défaut
            'label_format' => 'author.new.%name%',
        ]);
    }
}
