<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 9:24 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="datetime")
     */
    public $startTime;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    public $price;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @ORM\ManyToOne(targetEntity="Table", inversedBy="orders")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     */
    public $table;

    /**
     * @ORM\ManyToMany(targetEntity="Meal")
     * @ORM\JoinTable(name="meals_orders")
     */
    public $meals;
}