<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 10:08 PM
 */
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Restaurant;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends FOSRestController
{
    /**
     * @Rest\Get("/users")
     */
    public function getUsersAction(Request $request)
    {
        $data = ['getUsersAction' => 'not sdfsdfsdfdgsdfgdf yet'];
        return new JsonResponse("Nk");

    }

    /**
     * @Rest\Get("/users/{userId}")
     */
    public function getUsersByIdAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['getUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }

    /**
     * @Rest\Post("/postUsers")
     */
    public function postRestaurantAction(Request $request)
    {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);
        $restaurant = new Restaurant();
        $restaurant->setAddress($data["Address"]);
        $restaurant->setDescription($data["Description"]);
        $restaurant->setPhoneNumber($data["Phone"]);
        $restaurant->setTitle($data["Title"]);
        $restaurant->setWorkingHours($data["WorkingHours"]);
        $restaurant->setOwnerId($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($restaurant);
        $em->flush();

        return new JsonResponse($data);
    }

    /**
     * @Rest\Put("/users/{userId}")
     */
    public function putUsersByIdAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['putUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }

    /**
     * @Rest\Delete("/users/{userId}")
     */
    public function deleteUsersByIdAction(Request $request)
    {
        $userId = $request->get('userId');
        $data = ['deleteUsersByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }
}