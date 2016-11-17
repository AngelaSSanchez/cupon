<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class OfertaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion', null, array('label' => 'Descripción'))
            ->add('condiciones', null, array('label' => 'Condiciones'))
            ->add('foto', 'file', array('label' => 'Fotografía', 'required' => false))
            ->add('precio', 'money')
            ->add('descuento', 'money')
            ->add('umbral', null, array('label' => 'Compras necesarias'))
            ->add('guardar', 'submit', array(
                'label' => 'Guardar cambios',
                'attr' => array('class' => 'boton'),
                ))
            ->add('acepto', 'checkbox', array('mapped' => false,
                    'constraints' => new IsTrue(array(
                        'message' => 'Debes aceptar las condiciones legales antes de añadir una oferta',
                            ))
                ))    
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Oferta'
        ));
    }
    
    public function getBlockPrefix() {
        return 'oferta';
    }
}
