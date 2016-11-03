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
     * @Route("/order/{restaurantId}", name="order")
     */
    public function orderAction(Request $request)
    {
        $user = $this->getUser();

        if($user != null)
        {
            $restaurantId = $request->attributes->get('restaurantId');
            $restaurant = $this->get('app.restaurant')->getRestaurantById($restaurantId);
            $order = new Order();
            $order->setRestaurant($restaurant);
            $order->setUser($user);
            $form = $this->createForm(OrderType::class, $order);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $order = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($order);
                $em->flush();
                return $this->render('Order/order.html.twig', array(
                    'restaurant' => $restaurant,
                    'form' => $form->createView()
                ));
            }

            return $this->render('Order/order.html.twig', array(
                'restaurant' => $restaurant,
                'form' => $form->createView()
            ));
        }

        return $this->redirect("/login");
    }

    /**
     * @Route("/restaurantOrders/{restaurantId}", name="orderCheck")
     */
    public function restaurantOrdersAction(Request $request)
    {
        $restaurantId = $request->attributes->get('restaurantId');
        $doctrine = $this->getDoctrine();

        $orderRepo = $doctrine->getRepository('AppBundle:Order');

        $query = $orderRepo->createQueryBuilder('o')
            ->where('o.restaurant =' . $restaurantId)
            ->getQuery();

        $orders = $query->getResult();

        return $this->render('Order/restaurantOrders.html.twig', array(
            'orders' => $orders
        ));
    }
}