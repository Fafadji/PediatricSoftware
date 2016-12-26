<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table(name="ps_patient")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\PatientRepository")
 */
class Patient extends Person
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
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Mother")
   * @ORM\JoinColumn(nullable=false)
   */
    protected $mother;
    
  /**
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Father")
   * @ORM\JoinColumn(nullable=false)
   */
    protected $father;


    public function __construct() // Constructeur demandant 2 paramètres
    {
        parent::__construct(Person::$TYPES['TYPE_CHILD']);
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

