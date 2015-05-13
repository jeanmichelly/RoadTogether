<?php

namespace CV\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RatingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('evaluation',     'integer', array('attr' => array('min' => '1', 'max' => 5)))
        ->add('description',    'textarea', array('attr' => array('rows' => '5')))
        ->add('publier',        'submit');
    }

    /**
     * @return string
     */
    public function getName() {
        return 'cv_platformbundle_rating';
    }
}
