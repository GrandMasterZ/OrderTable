<?php
/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/2/2016
 * Time: 7:21 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if($user != null)
        {
            return $this->render('default/index.html.twig');
        }

        return $this->redirect("/login");
    }

    /**
     * @Route("/order/{restaurandId}", name="order")
     */
    public function orderAction(Request $request)
    {
        $user = $this->getUser();
        if($user != null)
        {
            $doctrine = $this->getDoctrine();
            $restaurandId = $request->attributes->get('restaurandId');
            $restaurantRepository = $doctrine->getRepository('AppBundle:Restaurant');
            $mealRepository = $doctrine->getRepository('AppBundle:Meal');
            $tableRepository = $doctrine->getRepository('AppBundle:Table');

            $meals = $mealRepository->findAll();
            $tables = $tableRepository->findAll();

            $em    = $this->get('doctrine.orm.entity_manager');
            $dql   = "SELECT a FROM AppBundle:Meal a";
            $query = $em->createQuery($dql);

            $paginator  = $this->get('knp_paginator');
            $paginationMeals = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );

            $restaurant = $restaurantRepository->find($restaurandId);
            return $this->render('Order/order.html.twig', array(
                'restaurant' => $restaurant,
                'meals' => $paginationMeals,
                'tables' => $tables
            ));
        }

        return $this->redirect("/login");
    }
}