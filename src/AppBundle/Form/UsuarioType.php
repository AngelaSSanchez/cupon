<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre')
        ->add('apellidos')
        ->add('email')
        ->add('password', RepeatedType::class, array( 
              'type' => PasswordType::class,
              'invalid_message' => 'Las dos contraseñas deben coincidir', 
              'first_options'	=> array('label' => 'Contraseña'), 
              'second_options'	=> array('label' => 'Repite Contraseña'),
              ))
        ->add('direccion')
        ->add('permiteEmail','checkbox', array( 
                'required' => false))
        ->add('fechaNacimiento','birthday')
        ->add('dni')
        ->add('numeroTarjeta')
        ->add('ciudad')
        ->add('registrarme', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Usuario',
        ));
    }
    public function getBlockPrefix()
    {
    return 'usuario';
    }
}

