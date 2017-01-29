<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use \DateTime;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Person
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Entrer au moins {{ limit }} charactères",
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Entrer au moins {{ limit }} charactères",
     * )
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^(fe)?male$/",
     *     match=true,
     *     message="Sex should be male or female"
     * )
     */
    private $sex;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $birthday;
    
    
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_phone", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/^(33|77|76) \d{3} \d{2} \d{2}$/",
     *     match=true,
     *     message="Entrer un numéro au format 33|77|76 xxx xx xx"
     * )
     * 
     */
    private $personalPhone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;
    
    
    const SEX_MALE='male';
    const SEX_FEMALE='female';
    
    
    public static $TYPES= array (
        'TYPE_FATHER' => 'father',
        'TYPE_MOTHER' => 'mother',
        'TYPE_TUTOR' => 'tutor',
        'TYPE_PATIENT' => 'patient',
                                );


    
    protected function __construct($type)
    {
      $this->setType($type);
    }
    
    public function __toString()
    {
        return  'Name : ' . $this->getName() .' | Surname : '. $this->getSurname(); 
    }
    
    /**
    * @ORM\PostLoad
    */
    public function reloadConstructInit() {
        $this->__construct();
    }

    // if any of the properties is set, then the name should not be null
  /**
   * @Assert\Callback
   */
    public function personValidation(ExecutionContextInterface $context) {
        
        if(!$this->isPersonValid()) {
            $context
                ->buildViolation('person.not.valid.name.empty') 
                ->atPath('name')                                                   
                ->addViolation() ;
        }
    }
    
    public function isPersonValid() {
        $onePropertySet = false;
        if(!empty( $this->getBirthday() ) or !empty( $this->getPersonalPhone() ) or !empty( $this->getSurname() )  ) {
            $onePropertySet = true;
        }
        
        if( $this->isPatient() and !empty( $this->getSex() )) {
            $onePropertySet = true;
        }

        if($onePropertySet and empty( $this->getName() )) {
            return false;
        }
        return true;
    }

    
    public function getAge()
    {
        $age = null;
        $today = new DateTime("now"); 
        if(isset($this->birthday) and ($today > $this->birthday) ) {
            $age = $this->birthday->diff($today); 
        }
        return $age;
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
    
    private function setType($type)
    {
        
        if(!in_array($type, Person::$TYPES)) 
        {
            throw new InvalidOptionsException("Non Existing Person type : $type");
        }
        
        $this->type = $type;
        
        if($type == Person::$TYPES['TYPE_FATHER'])
        {
            $this->setSex(Person::SEX_MALE);
        } 
        elseif ($type == Person::$TYPES['TYPE_MOTHER']) 
        {
            $this->setSex(Person::SEX_FEMALE);
        }

        return $this;
    }
    
    public function getType()
    {
        if(!isset($this->type)) return "unknown";
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Person
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }
    
    public function isMale()
    {
        return ($this->getSex() == Person::SEX_MALE);
    }
    
    public function isFemale()
    {
        return ($this->getSex() == Person::SEX_FEMALE);
    }
    
    public function isPatient()
    {
        return ($this->getType() == Person::$TYPES['TYPE_PATIENT']);
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Person
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set personalPhone
     *
     * @param string $personalPhone
     *
     * @return Person
     */
    public function setPersonalPhone($personalPhone)
    {
        $this->personalPhone = $personalPhone;

        return $this;
    }

    /**
     * Get personalPhone
     *
     * @return string
     */
    public function getPersonalPhone()
    {
        return $this->personalPhone;
    }
    

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Person
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }



}
