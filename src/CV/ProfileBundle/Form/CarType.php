<?php

namespace CV\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $choiceMark = array(
            'Renault' => 'Renault',
            'Peugeot' => 'Peugeot',
        );

        $choiceYearCommissionning = array();

        for($i=1950; $i<=date("Y"); $i++) {
            $choiceYearCommissionning[$i] = $i;
        } 

        $choiceNumberPlace = array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
        );

        $choiceComfort = array(
            'Basique' => 'Basique',
            'Normal' => 'Normal',
            'Confort' => 'Confort',
            'Luxe' => 'Luxe',
        );

        $choiceColor = array(
            'Noir' => 'Noir',
            'Bleu' => 'Bleu',
            'Vert' => 'Vert',
            'Rouge' => 'Rouge',
        );

        $choiceCategory = array(
            'Véhicule de tourisme' => 'Véhicule de tourisme',
            'Berline' => 'Berline',
            'Cabriolet' => 'Cabriolet',
            'Break' => 'Break',
            'Monospace' => 'Monospace',
        );

        $builder
            ->add('mark', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez une marque -',
              'empty_data'  => -1,
              'choices' => $choiceMark))

            ->add('model',               'text')

            ->add('yearCommissionning', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez lannée de mise en service',
              'empty_data'  => -1,
              'choices' => $choiceYearCommissionning))

            ->add('comfort', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez le confort -',
              'empty_data'  => -1,
              'choices' => $choiceComfort))

            ->add('numberPlace', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez le nombre de places -     (incluant le conducteur)',
              'empty_data'  => -1,
              'choices' => $choiceNumberPlace))

            ->add('color', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez la couleur -',
              'empty_data'  => -1,
              'choices' => $choiceColor))

            ->add('category', 'choice',array(
              'multiple' => false,
              'expanded' => false,
              'empty_value' => '- Choisissez la catégorie -',
              'empty_data'  => -1,
              'choices' => $choiceCategory))
            ->add('picture',             'text')
            ->add('enregistrer',       'submit');
    ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CV\ProfileBundle\Entity\Car'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cv_profilebundle_car';
    }
}
