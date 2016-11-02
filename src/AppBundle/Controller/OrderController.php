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

            $restaurant = $restaurantRepository->find($restaurandId);
            return $this->render('Order/order.html.twig', array(
                'restaurant' => $restaurant
            ));
        }

        return $this->redirect("/login");
    }
}