<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 9:18 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Tables")
 */
class Table
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="integer")
     */
    public $seats;

    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="tables")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
     */
    public $restaurant;
}