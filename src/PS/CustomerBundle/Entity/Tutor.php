<?php

namespace PS\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutor
 *
 * @ORM\Table(name="ps_tutor")
 * @ORM\Entity(repositoryClass="PS\CustomerBundle\Repository\TutorRepository")
 */
class Tutor extends Person
{
    public function __construct() 
    {
        parent::__construct(Person::$TYPES['TYPE_TUTOR']);
    }
}

