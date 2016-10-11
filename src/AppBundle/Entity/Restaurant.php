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
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string")
     */
    private $working_hours;

    /**
     * @ORM\Column(type="string")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $ownerId;

    /**
     * @ORM\Column(type="array")
     */
    private $images;

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getWorkingHours()
    {
        return $this->working_hours;
    }

    /**
     * @param mixed $working_hours
     */
    public function setWorkingHours($working_hours)
    {
        $this->working_hours = $working_hours;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return mixed
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * @param mixed $meals
     */
    public function setMeals($meals)
    {
        $this->meals = $meals;
    }

    /**
     * @return mixed
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * @param mixed $tables
     */
    public function setTables($tables)
    {
        $this->tables = $tables;
    }

    /**
     * @ORM\OneToMany(targetEntity="Meal", mappedBy="restaurant")
     */
    private $meals;

    /**
     * @ORM\OneToMany(targetEntity="Table", mappedBy="restaurant")
     */
    private $tables;
}