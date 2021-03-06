<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mother
 *
 * @ORM\Table(name="ps_mother")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\MotherRepository")
 */
class Mother extends Person
{
    public function __construct() 
    {
        parent::__construct(Person::$TYPES['TYPE_MOTHER']);
    }

}

