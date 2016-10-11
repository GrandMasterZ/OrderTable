<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 10:08 PM
 */
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Restaurant;
use AppBundle\Mapper\RestaurantMapper;
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
     * @Rest\Post("/postRestaurant")
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
     * @Rest\Get("/restaurants")
     */
    public function getRestaurants(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Restaurant');

        $restaurants = $repository->findAll();
        $restaurantList = [];

        foreach ($restaurants as $restaurant)
        {
            $mappedRestaurant = new RestaurantMapper();
            $mappedRestaurant->address = $restaurant->getAddress();
            $mappedRestaurant->description = $restaurant->getDescription();
            $mappedRestaurant->id = $restaurant->getId();
            $mappedRestaurant->ownerId = $restaurant->getOwnerId()->getId();
            $mappedRestaurant->phone_number = $restaurant->getPhoneNumber();
            $mappedRestaurant->title = $restaurant->getTitle();
            $mappedRestaurant->working_hours = $restaurant->getWorkingHours();
            $mappedRestaurant->ownerUsername = $restaurant->getOwnerId()->getName();

            array_push($restaurantList, $mappedRestaurant);
        }

        return new JsonResponse($restaurantList);
    }

    /**
     * @Rest\Get("/restaurant/{restaurantId}")
     */
    public function getRestaurantById(Request $request)
    {
        $restaurantId = $request->get('restaurantId');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Restaurant');

        $restaurant = $repository->find($restaurantId);

        $mappedRestaurant = new RestaurantMapper();
        $mappedRestaurant->address = $restaurant->getAddress();
        $mappedRestaurant->description = $restaurant->getDescription();
        $mappedRestaurant->id = $restaurant->getId();
        $mappedRestaurant->ownerId = $restaurant->getOwnerId()->getId();
        $mappedRestaurant->phone_number = $restaurant->getPhoneNumber();
        $mappedRestaurant->title = $restaurant->getTitle();
        $mappedRestaurant->working_hours = $restaurant->getWorkingHours();
        $mappedRestaurant->ownerUsername = $restaurant->getOwnerId()->getName();

        return new JsonResponse($mappedRestaurant);
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