<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/29/16
 * Time: 9:00 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Restaurants")
 */
class Restaurant
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
     * @ORM\Column(type="string")
     */
    public $address;

    /**
     * @ORM\Column(type="string")
     */
    public $working_hours;

    /**
     * @ORM\Column(type="string")
     */
    public $phone_number;

    /**
     * @ORM\Column(type="string")
     */
    public $description;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $ownerId;

    /**
     * @ORM\OneToMany(targetEntity="Meal", mappedBy="meal")
     */
    public $meals;

    /**
     * @ORM\OneToMany(targetEntity="Table", mappedBy="tables")
     */
    public $tables;
}