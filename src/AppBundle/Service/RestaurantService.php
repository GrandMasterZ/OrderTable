<?php

/**
 * Created by PhpStorm.
 * User: asdasd
 * Date: 11/3/2016
 * Time: 12:25 PM
 */

namespace AppBundle\Service;

class RestaurantService
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRestaurantById($restaurantId)
    {
        $repo = $this->em->getRepository('AppBundle:Restaurant');
        $restaurant = $repo->find($restaurantId);

        return $restaurant;
    }

    public function createQuery($restaurantId)
     {
        $dql = "SELECT a FROM AppBundle:Meal a WHERE a.restaurant =" .$restaurantId;
        $query = $this->em->createQuery($dql);

        return $query;
    }

    public function getRestaurantByUserId($userId)
    {
        $repo = $this->em->getRepository('AppBundle:Restaurant');
        $query = $repo->createQueryBuilder('p')
            ->where('p.ownerId = ' . $userId)
            ->getQuery();

        $restaurants = $query->getResult();

        return $restaurants;
    }
}