<?php

namespace JobBoardBundle\Form;

use JobBoardBundle\ListKeyWord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdvertType extends AbstractType
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

        $builder->add('title')
            ->add('content')
            ->add('keyWords', ChoiceType::class, array(
                'choices' => $skills,
                'multiple' => true,
                'expanded' => true
                ))
            ->add('Submit', SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobBoardBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobboardbundle_advert';
    }


}
