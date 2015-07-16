<?php

namespace ClicSape\Bundle\ClotheBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupSizeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('disabled','checkbox')
            ->add('title','text')
            ->add('sizes','collection',array(
                'type' => 'size_type',
                'allow_add' => true,
                'by_reference' => false,
                'required' => true
            ))
            ->add('categories','entity',array(
                'class' => 'ClicSapeClotheBundle:Category',
                'choice_label' => 'title',
                'multiple' => true,
                'by_reference' => false,
                'required' => true
            ))
            ->add('countries','entity',array(
                'class' => 'ClicSapeCoreBundle:Country',
                'choice_label' => 'wording',
                'multiple' => true,
                'by_reference' => false,
                'required' => true
            ))
            ->add('ajouter','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClicSape\Bundle\ClotheBundle\Entity\GroupSize'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'groupsize_type';
    }
}