<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Person
 *
 * @ORM\MappedSuperclass
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
     * @Assert\Regex("M|F")
     */
    protected $sex;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_phone", type="string", length=255, nullable=true)
     */
    protected $personalPhone;


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
}

