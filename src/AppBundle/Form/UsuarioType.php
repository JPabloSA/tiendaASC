<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usNombre',TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => "Nombre"
            ))
            ->add('usDireccion',TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => "Direccion"
            ))
            ->add('usTelefono',TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => "Telefono"
            ))
            ->add('username',TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => "Nombre de usuario"
            ))
            ->add('password',PasswordType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => "Contraseña"
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}
