<?php

namespace JobBoardBundle\Form;

use JobBoardBundle\ListKeyWord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $skills = array();
        foreach (ListKeyWord::$skills as $key => $element){
            $skills[$key] = $element;
        }

        $builder
            ->add('nom', ChoiceType::class, array(
                'choices' => $skills
            ))
            ->add('niveau')
            ->add('commentaire', TextareaType::class)
            ->add('Ajouter', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobBoardBundle\Entity\Competence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobboardbundle_competence';
    }


}
