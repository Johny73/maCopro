<?php

namespace App\Form;

use App\Entity\Comptes;
use App\Entity\Journal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class JournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        
            
        $builder
            ->add('date', DateType::class, ['widget' => 'single_text', 
                'data' => new \DateTime(), ] )
            ->add('montant', NumberType::class)
            ->add('compteDebit', EntityType::class, [
                'class' => Comptes::class,
                'label' => 'Compte à débiter'
            ])
            ->add('compteCredit', EntityType::class, [
                'class' => Comptes::class,
                'label' => 'Compte à créditer',
            ])
            ->add('commentaire', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Valider','attr' => ['class' => 'btn btn-primary'],])

        ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Journal::class,
            
        ]);
    }
}
