<?php

namespace App\Form;

use App\Entity\Detail;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company_number')
            ->add('company_name')
            ->add('address')
            ->add('city')
            ->add('postal_code')
            ->add('country')
            ->add('portfolio_link')
            ->add('portfolio_check')
            ->add('strikes')
            ->add('is_banned')
            ->add('created_at', null, [
                'widget' => 'single_text'
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text'
            ])
            ->add('pro', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detail::class,
        ]);
    }
}
