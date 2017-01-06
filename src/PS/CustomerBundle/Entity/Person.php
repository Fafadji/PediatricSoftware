<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use \DateTime;

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
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    protected $surname;

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
    protected $sex;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    protected $birthday;
    
    
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_phone", type="string", length=255, nullable=true)
     */
    protected $personalPhone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    protected $comment;

    const SEX_MALE='male';
    const SEX_FEMALE='female';
    
    
    public static $TYPES= array (
        'TYPE_FATHER' => 'father',
        'TYPE_MOTHER' => 'mother',
        'TYPE_TUTOR' => 'tutor',
        'TYPE_PATIENT' => 'patient',
                                );

    /**
    * @ORM\PostLoad
    */
    public function reloadConstructInit() {
        $this->__construct();
    }
    
    protected function __construct($type)
    {
      $this->setType($type);
    }

    public function getAge()
    {
        $age = null;
        if(isset($this->birthday)) {
            $today = new DateTime("now"); 
            $interval = $this->birthday->diff($today); 
            $age = $interval;
            
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
