<?php
/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/3/2016
 * Time: 1:41 PM
 */

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        var_dump($options['restaurantId']);
        $builder
            ->add('table', EntityType::class, array(
                'class' => 'AppBundle:Table',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.seats')
                        ->where('u.restaurant ='. $options['restaurantId']);
                },
                'choice_label' => 'seats',
            ))
            ->add('meals', EntityType::class,array(
                'class' => 'AppBundle:Meal',
                'required' => false,
                'property' => 'uniqueName',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->where('u.restaurant ='. $options['restaurantId']);
                },
            ))
            ->add('start_time', DateTimeType::class)
            ->add('save', SubmitType::class, array('label' => 'Order'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order',
            'restaurantId' => null
        ));
    }
}