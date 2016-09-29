<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 9:10 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Meals")
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    public $price;

    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="meals")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
    public $restaurant;
}