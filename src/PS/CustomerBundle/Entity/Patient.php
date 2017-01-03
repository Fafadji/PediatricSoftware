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
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Mother", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
    protected $mother;
    
  /**
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Father", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
    protected $father;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="code_siblings", type="string", length=255, nullable=true)
     */
    protected $codeSiblings;


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

    /**
     * Set mother
     *
     * @param \PS\CustomerBundle\Entity\Mother $mother
     *
     * @return Patient
     */
    public function setMother(\PS\CustomerBundle\Entity\Mother $mother = null)
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * Get mother
     *
     * @return \PS\CustomerBundle\Entity\Mother
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Set father
     *
     * @param \PS\CustomerBundle\Entity\Father $father
     *
     * @return Patient
     */
    public function setFather(\PS\CustomerBundle\Entity\Father $father = null)
    {
        $this->father = $father;

        return $this;
    }

    /**
     * Get father
     *
     * @return \PS\CustomerBundle\Entity\Father
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set codeSiblings
     *
     * @param string $codeSiblings
     *
     * @return Patient
     */
    public function setCodeSiblings($codeSiblings)
    {
        $this->codeSiblings = $codeSiblings;

        return $this;
    }

    /**
     * Get codeSiblings
     *
     * @return string
     */
    public function getCodeSiblings()
    {
        return $this->codeSiblings;
    }
}
