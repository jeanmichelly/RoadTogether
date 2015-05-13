<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileRegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->remove('enregistrer')
        ->remove('biography')
        ->remove('phone')
        ->remove('biography')
        ->remove('age');
    }
    
    public function getParent() {
     return new ProfileType();
 }

    /**
     * @return string
     */
    public function getName() {
        return 'cv_profilebundle_profile_registration';
    }
}
