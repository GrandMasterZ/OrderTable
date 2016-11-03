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
use AppBundle\Form\OrderType;
use AppBundle\Entity\Order;

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
            $tableRepository = $doctrine->getRepository('AppBundle:Table');

            $order = new Order();
            $tables = $tableRepository->findAll();

            $form = $this->createForm(OrderType::class, $order);
            $form->handleRequest($request);

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
                'tables' => $tables,
                'form' => $form->createView()
            ));
        }

        return $this->redirect("/login");
    }
}