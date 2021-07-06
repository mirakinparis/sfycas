<?php

namespace App\Form\Type;

use App\Form\DataTransformer\SfyCASRoleTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SfyCASRoleType extends AbstractType
{
    /*public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'Admin role' => 'ROLE_ADMIN',
                'CAS user role' => 'ROLE_CAS_USER',
            ],
        ]);
    }*/

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->addViewTransformer(new SfyCASRoleTransformer());
    }

    public function getParent()
    {
        return TextType::class;
    }
}