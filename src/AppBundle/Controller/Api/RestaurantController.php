<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 10:08 PM
 */
namespace AppBundle\Controller\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RestaurantController extends Controller
{
    /**
     * @Route("/api/programmers")
     * @Method("POST")
     */
    public function newAction()
    {
        return new Response('Let\'s do this!');
    }
}