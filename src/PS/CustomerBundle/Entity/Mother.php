<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mother
 *
 * @ORM\Table(name="ps_mother")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\MotherRepository")
 */
class Mother extends Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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

