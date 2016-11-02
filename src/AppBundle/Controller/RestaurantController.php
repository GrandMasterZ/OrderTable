<?php
/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/2/2016
 * Time: 9:02 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Meal;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;


class RestaurantController extends Controller
{
    /**
     * @Route("/ownedRestaurants", name="ownedRest")
     */
    public function ownedRestaurantsAction(Request $request)
    {
        $user = $this->getUser();

        if($user != null)
        {
            $doctrine = $this->getDoctrine();

            $restaurantRepository = $doctrine->getRepository('AppBundle:Restaurant');

            $query = $restaurantRepository->createQueryBuilder('p')
                ->where('p.ownerId = ' . $user->getId())
                ->getQuery();

            $restaurants = $query->getResult();

            return $this->render('Restaurant/restaurants.html.twig', array(
                'restaurants' => $restaurants
            ));
        }

        return $this->redirect("/login");
    }

    /**
     * @Route("/addMeals/{restaurantId}", name="addMeals")
     */
    public function addMealsAction(Request $request)
    {
        $user = $this->getUser();
        $doctrine = $this->getDoctrine();
        if($user != null)
        {
            $restaurantId = $request->attributes->get('restaurantId');
            $restaurantRepository = $doctrine->getRepository('AppBundle:Restaurant');
            $restaurant = $restaurantRepository->find($restaurantId);

            $mealRepository = $doctrine->getRepository('AppBundle:Meal');
            $meals = $mealRepository->findAll();
            $em    = $this->get('doctrine.orm.entity_manager');
            $dql   = "SELECT a FROM AppBundle:Meal a";
            $query = $em->createQuery($dql);

            $meal = new Meal();
            $meal->setRestaurant($restaurant);

            $form = $this->createFormBuilder($meal)
                ->add('title', TextType::class)
                ->add('price', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Pridėti patiekalą'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $meal = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($meal);
                $em->flush();
            }

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );

            return $this->render('Restaurant/meals.html.twig', array(
                'form' => $form->createView(),
                'mealsPagination' => $pagination
            ));
        }

        return $this->redirect("/login");
    }
}