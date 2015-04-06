<?php

namespace CV\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RideSearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
                $builder->remove('enregistrer');
                $builder->remove('price');
                $builder->remove('numberPassenger');
                $builder->remove('details');
                $builder->add('rechercher',         'submit');
                               
    }
    
    public function getParent() {
       return new RideType();
    }

    /**
     * @return string
     */
    public function getName() {
        return 'cv_platformbundle_ride_search';
    }
}