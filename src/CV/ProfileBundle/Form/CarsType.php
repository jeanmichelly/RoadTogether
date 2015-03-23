<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CV\ProfileBundle\Form\CarType;

class CarsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                    ->add('enregistrer',         'submit')
            ->add('cars', 'collection', array(
        'type'         => new CarType(),
        'allow_add' => true,
        'allow_delete' => true,
        'mapped' => false,
        'by_reference' => false,
        ))
    ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cv_profilebundle_cars';
    }
}
