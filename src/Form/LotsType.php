<?php

namespace App\Form;

use App\Entity\Lots;
use App\Entity\Proprietaires;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LotsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numLot')
            ->add('numero')
            ->add('voie')
            ->add('codePostal')
            ->add('ville')
            ->add('quotePart')
            ->add('proprietaire')
            /*, EntityType::class, [
                'class' => Proprietaires::class,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lots::class,
        ]);
    }
}
