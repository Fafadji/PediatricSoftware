<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="ps_address")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\AddressRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\Regex(
     *     pattern="/^(33|77|76) \d{3} \d{2} \d{2}$/",
     *     match=true,
     *     message="Entrer un numéro au format 33|77|76 xxx xx xx"
     * )
     */
    private $homePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="homeFullAddress", type="text", nullable=true)
     */
    private $homeFullAddress;


    public function __toString()
    {
        return 'Address : ' . $this->getHomeFullAddress() . ' | Phone : ' . $this->getHomePhone();
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
}

