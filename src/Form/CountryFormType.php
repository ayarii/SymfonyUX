<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('country', ChoiceType::class, [
            'choices' => [
                'France' => 'fr',
                'Germany' => 'de',
                'Italy' => 'it',
                'Spain' => 'es',
                'Canada' => 'ca',
                'Tunisia' => 'tn',
                'Morocco' => 'ma',
                'Japan' => 'jp',
            ],
            'autocomplete' => true,
            'placeholder' => 'Choisissez un pays...',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
