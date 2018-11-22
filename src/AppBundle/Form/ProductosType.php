<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ProductosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proNombre', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('proStockMinimo', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('proPreciocompra', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('proPrecioventa', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('img', FileType::class, array(
                "label" => "Imagen:",
                "attr" =>array("class" => "form-control")
            ))
            ->add('categoriacategoria', EntityType::class, array(
                // looks for choices from this entity
                'class' => 'AppBundle:Categoria',

                // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
                "attr" =>array("class" => "form-control")

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Productos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_productos';
    }


}
