<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarViewType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->remove('enregistrer');
    }
    
    public function getParent() {
       return new CarType();
    }

    /**
     * @return string
     */
    public function getName() {
        return 'cv_profilebundle_car_view';
    }
}
