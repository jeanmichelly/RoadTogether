<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CV\PlatformBundle\Form\ImageType;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',               'text')
            ->add('firstName',          'text')
            ->add('age',                'integer', array('attr' => array('min' => '10', 'max' => '100')))
            ->add('biography',          'textarea')
            ->add('birthday',           'date')
            ->add('phone',              'text')
            ->add('image',      new ImageType(), array("required" => false)) 
            ->add('enregistrer',        'submit') 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CV\ProfileBundle\Entity\Profile'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cv_profilebundle_profile';
    }
}
