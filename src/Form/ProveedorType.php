<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('email')
            ->add('telefono')
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Hotel' => 'Hotel',
                    'Crucero' => 'Crucero',
                    'Estación de esquí' => 'Estación de esquí',
                    'Parque temático' => 'Parque temático',
                ],
                'placeholder' => 'Selecciona un tipo',
            ])            
            ->add('activo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
