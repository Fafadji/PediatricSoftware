<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Patient
 *
 * @ORM\Table(name="ps_patient")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\PatientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Patient extends Person
{
    
  /**
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Mother", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   * @Assert\Valid()
   */
    protected $mother;
    
  /**
   * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Father", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   * @Assert\Valid()
   */
    protected $father;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="code_siblings", type="string", length=255, nullable=true)
     */
    protected $codeSiblings;
    
    /**
     * @var string
     *
     * @ORM\Column(name="personal_diseases_history", type="text", nullable=true)
     */
    private $personalDiseasesHistory;
    
    /**
     * @var string
     *
     * @ORM\Column(name="family_diseases_history", type="text", nullable=true)
     */
    private $familyDiseasesHistory;
    
    
    private $liveWith;


    public function __construct() // Constructeur demandant 2 paramètres
    {
        parent::__construct(Person::$TYPES['TYPE_PATIENT']);
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
        return $this->mother ;
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

    /**
     * Set personalDiseasesHistory
     *
     * @param string $personalDiseasesHistory
     *
     * @return Patient
     */
    public function setPersonalDiseasesHistory($personalDiseasesHistory)
    {
        $this->personalDiseasesHistory = $personalDiseasesHistory;

        return $this;
    }

    /**
     * Get personalDiseasesHistory
     *
     * @return string
     */
    public function getPersonalDiseasesHistory()
    {
        return $this->personalDiseasesHistory;
    }

    /**
     * Set familyDiseasesHistory
     *
     * @param string $familyDiseasesHistory
     *
     * @return Patient
     */
    public function setFamilyDiseasesHistory($familyDiseasesHistory)
    {
        $this->familyDiseasesHistory = $familyDiseasesHistory;

        return $this;
    }

    /**
     * Get familyDiseasesHistory
     *
     * @return string
     */
    public function getFamilyDiseasesHistory()
    {
        return $this->familyDiseasesHistory;
    }
    
    /**
     * Set livesWith
     *
     * @param string $livesWith
     *
     * @return Person
     */
    public function setAddress(\PS\CustomerBundle\Entity\Address $address = null)
    {
        throw new LogicException("Not allowed to set Address in Patient. Use setLivesWith insted");
    }
    
}
