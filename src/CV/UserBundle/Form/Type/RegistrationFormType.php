<?php

namespace CV\UserBundle\Form\Type;

use CV\ProfileBundle\Form\ProfileRegistrationType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('profile', new ProfileRegistrationType());
    }

    public function getName()
    {
        return 'cv_user_registration';
    }
}