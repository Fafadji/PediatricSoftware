<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FATHER
 *
 * @ORM\Table(name="ps_father")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\FatherRepository")
 */
class Father extends Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    
    public function __construct() 
    {
        parent::__construct(Person::$TYPES['TYPE_FATHER']);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

