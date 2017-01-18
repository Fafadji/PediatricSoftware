<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Address
 *
 * @ORM\Table(name="ps_address")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="homePhone", type="string", length=255, nullable=true)
     */
    private $homePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="homeFullAddress", type="text")
     */
    private $homeFullAddress;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"homeFullAddress"})
     * @ORM\Column(name="homeSlugAdress", type="string", length=255, unique=true)
     */
    private $homeSlugAdress;


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
     * Set homePhone
     *
     * @param string $homePhone
     *
     * @return Address
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;

        return $this;
    }

    /**
     * Get homePhone
     *
     * @return string
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * Set homeFullAddress
     *
     * @param string $homeFullAddress
     *
     * @return Address
     */
    public function setHomeFullAddress($homeFullAddress)
    {
        $this->homeFullAddress = $homeFullAddress;

        return $this;
    }

    /**
     * Get homeFullAddress
     *
     * @return string
     */
    public function getHomeFullAddress()
    {
        return $this->homeFullAddress;
    }

    /**
     * Set homeSlugAdress
     *
     * @param string $homeSlugAdress
     *
     * @return Address
     */
    public function setHomeSlugAdress($homeSlugAdress)
    {
        $this->homeSlugAdress = $homeSlugAdress;

        return $this;
    }

    /**
     * Get homeSlugAdress
     *
     * @return string
     */
    public function getHomeSlugAdress()
    {
        return $this->homeSlugAdress;
    }
}

