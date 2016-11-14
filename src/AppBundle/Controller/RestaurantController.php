<?php
/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/2/2016
 * Time: 9:02 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Meal;
use AppBundle\Entity\Table;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\MealType;
use AppBundle\Form\TableType;


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
            $restaurants = $this->get('app.restaurant')->getRestaurantByUserId($user->getId());

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

        if($user != null)
        {
            $restaurantId = $request->attributes->get('restaurantId');
            $restaurant = $this->get('app.restaurant')->getRestaurantById($restaurantId);

            $query = $this->get('app.restaurant')->createQuery($restaurantId);

            $meal = new Meal();
            $meal->setRestaurant($restaurant);

            $form = $this->createForm(MealType::class, $meal);

            $form->handleRequest($request);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );

            if ($form->isSubmitted() && $form->isValid()) {
                $meal = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($meal);
                $em->flush();

                $pagination = $paginator->paginate(
                    $query,
                    $request->query->getInt('page', 1),
                    10
                );

                return $this->render('Restaurant/meals.html.twig', array(
                    'form' => $form->createView(),
                    'mealsPagination' => $pagination
                ));
            }


            return $this->render('Restaurant/meals.html.twig', array(
                'form' => $form->createView(),
                'mealsPagination' => $pagination
            ));
        }

        return $this->redirect("/login");
    }

    /**
     * @Route("/addTables/{restaurantId}", name="addTables")
     */
    public function addTablesAction(Request $request)
    {
        $user = $this->getUser();
        $doctrine = $this->getDoctrine();

        if($user != null) {

            $restaurantId = $request->attributes->get('restaurantId');
            $restaurant = $this->get('app.restaurant')->getRestaurantById($restaurantId);

            $tableRepository = $doctrine->getRepository('AppBundle:Table');

            $query = $tableRepository->createQueryBuilder('o')
                ->where('o.restaurant =' . $restaurantId)
                ->getQuery();

            $tables = $query->getResult();

            $table = new Table();
            $table->setRestaurant($restaurant);

            $form = $this->createForm(TableType::class, $table);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $table = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($table);
                $em->flush();

                $query = $tableRepository->createQueryBuilder('o')
                    ->where('o.restaurant =' . $restaurantId)
                    ->getQuery();

                $tables = $query->getResult();

                return $this->render('Restaurant/tables.html.twig', array(
                    'form' => $form->createView(),
                    'tables' => $tables
                ));
            }

            return $this->render('Restaurant/tables.html.twig', array(
                'form' => $form->createView(),
                'tables' => $tables
            ));
        }

        return $this->redirect("/login");
    }
}