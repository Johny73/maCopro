<?php

namespace App\Form;

use App\Entity\Proprietaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numero')
            ->add('voie')
            ->add('codePostal')
            ->add('ville')
            /*les placeholder ont été enlevé car affichage trop similair aux vraies données*/
            ->add('telPerso' /*, null, ['attr' => ['placeholder' => '012345678']]*/)
            ->add('telPro'/*, null, ['attr' => ['placeholder' => '012345678']]*/)
            ->add('mail'/*, null, ['attr' => ['placeholder' => 'monMail@gmail.fr']]*/)
            ->add('bic')
            ->add('iban')

            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proprietaires::class,
            'label_format' => 'proprio.%name%.label'

        ]);
    }
}