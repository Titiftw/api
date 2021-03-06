<?php

namespace Dba\AdminBundle\Form;

use Dba\GameBundle\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

class RequirementsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'key',
                Type\ChoiceType::class,
                [
                    'label' => 'form.key',
                    'choices' => array_flip(Entity\GameObject::REQUIREMENTS_LIST),
                ]
            )
            ->add(
                'value',
                Type\TextType::class,
                [
                    'label' => 'form.value',
                ]
            );
    }

    public function getBlockPrefix()
    {
        return 'requirements_type';
    }
}
