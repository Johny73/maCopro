<?php

namespace App\Form;

use App\Entity\Comptes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null, ['label_attr'  => ['class' =>'test',] ,])
            ->add('prenom',null, ['attr'  => ['class' =>'test',] ,])
            ->add('numero')
            ->add('voie')
            ->add('codePostal')
            ->add('ville')
            ->add('telPerso')
            ->add('telPro')
            ->add('mail')
            ->add('bic')
            ->add('iban')

            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comptes::class,
            'label_format' => 'proprio.%name%.label'

        ]);
    }
}