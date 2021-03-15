<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Auteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label'=>'Nom',
            ])
            ->add('texte', TextareaType::class, [
                'label'=> 'Texte'
            ])
            ->add('auteur',EntityType::class
                , [
                    'class' => Auteur::class,
                    'required' => true,
                    'expanded' => false,
                    'placeholder' => 'Auteur',
                    'choice_label' => function ($auteur) {
                        return $auteur->getNom();
                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
