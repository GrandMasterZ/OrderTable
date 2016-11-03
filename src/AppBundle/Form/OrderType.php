<?php
/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/3/2016
 * Time: 1:41 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('table', EntityType::class, array(
                'class' => 'AppBundle:Table',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u');
                },
                'choice_label' => 'seats',
            ))
            ->add('save', SubmitType::class, array('label' => 'Order'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order'
        ));
    }
}