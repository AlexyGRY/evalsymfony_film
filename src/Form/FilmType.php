<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;



class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class)
            ->add('description', TextType::class)
            ->add('sortie', IntegerType::class, [
            'constraints' => [
                new Length(
                    min: 1900,
                    max: 2030,
                    minMessage:"L'année doit être entre {{ min }} et {{ max }}",
                    maxMessage: "L'année doit être entre {{ min }} et {{ max }}"
                )
                ]  ,
            ])
            ->add('affiche', UrlType::class)
                
            ->add('genre', EntityType::class, [
            'class' => Genre::class,
            'choice_label' => 'id',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
