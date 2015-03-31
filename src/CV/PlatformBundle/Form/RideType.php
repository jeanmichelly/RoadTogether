<?php

namespace CV\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RideType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('departure',         'text')
            ->add('arrival',           'text')
            ->add('departureDate',     'text')
            ->add('price',             'integer')
            ->add('numberPassenger',   'integer')
            ->add('details',           'textarea', array('attr' => array('rows' => '5')))
            ->add('enregistrer',       'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'CV\PlatformBundle\Entity\Ride'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'cv_platformbundle_ride';
    }
}
