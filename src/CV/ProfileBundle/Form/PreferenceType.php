<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreferenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $choiceDiscussion = array(
            '0' => 'Vous ne m\'entendrez pas beaucoup',
            '1' => 'J\'aime bien discuter',
            );

        $choiceMusic = array(
            '0' => 'Je n\'écoute pas de musique en voiture',
            '1' => 'J\'aime bien écouter de la musique',
            );

        $choiceCigarette = array(
            '0' => 'La cigarette me dérange',
            '1' => 'La cigarette ne me dérange pas',
            );

        $choiceAnimal = array(
            '0' => 'Je ne transporte pas d\'animaux',
            '1' => 'Je peux transporter des animaux',
            );

        $builder
        ->add('discussion',           'choice', array(
            'multiple' => 0,
            'expanded' => 1,
            'choices' => $choiceDiscussion))
        ->add('music',                'choice', array(
            'multiple' => 0,
            'expanded' => 1,
            'choices' => $choiceMusic))
        ->add('cigarette',            'choice', array(
            'multiple' => 0,
            'expanded' => 1,
            'choices' => $choiceCigarette))
        ->add('animal',               'choice', array(
            'multiple' => 0,
            'expanded' => 1,
            'choices' => $choiceAnimal))
        ->add('enregistrer',        'submit') 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CV\ProfileBundle\Entity\Preference'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cv_profilebundle_preference';
    }
}
