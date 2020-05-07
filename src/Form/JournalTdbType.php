<?php

namespace App\Form;

use App\Entity\Comptes;
use App\Entity\Journal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JournalTdbType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->getForm();
    }
}