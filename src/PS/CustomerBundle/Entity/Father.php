<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Father
 *
 * @ORM\Table(name="ps_father")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\FatherRepository")
 */
class Father extends Person
{
    public function __construct() 
    {
        parent::__construct(Person::$TYPES['TYPE_FATHER']);
    }
    
    /**
     * Get livesWith
     * @Assert\Regex(
     *     pattern="/^mother$/",
     *     match=true,
     *     message="livesWith should be mother"
     * )
     *
     * @return string
     */
    public function getLivesWith()
    {
        parent::getLivesWith();
    }
}

