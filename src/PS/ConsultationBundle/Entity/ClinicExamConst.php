<?php

namespace PS\ConsultationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClinicExamConst
 *
 * @ORM\Table(name="ps_clinic_exam_const")
 * @ORM\Entity(repositoryClass="PS\ConsultationBundle\Repository\ClinicExamConstRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ClinicExamConst
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
     * @var float
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float", nullable=true)
     */
    private $height;

    /**
     * @var float
     *
     * @ORM\Column(name="temperature", type="float", nullable=true)
     */
    private $temperature;

    /**
     * @var string
     *
     * @ORM\Column(name="bloodPressure", type="string", length=255, nullable=true)
     */
    private $bloodPressure;
    
    /**
     * @var float
     *
     * @ORM\Column(name="headCircumference", type="float", nullable=true)
     */
    private $headCircumference;


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
     * Set weight
     *
     * @param float $weight
     *
     * @return ClinicExamConst
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param float $height
     *
     * @return ClinicExamConst
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set temperature
     *
     * @param float $temperature
     *
     * @return ClinicExamConst
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set bloodPressure
     *
     * @param string $bloodPressure
     *
     * @return ClinicExamConst
     */
    public function setBloodPressure($bloodPressure)
    {
        $this->bloodPressure = $bloodPressure;

        return $this;
    }

    /**
     * Get bloodPressure
     *
     * @return string
     */
    public function getBloodPressure()
    {
        return $this->bloodPressure;
    }

    /**
     * Get bMI
     *
     * @return string
     */
    public function getBMI()
    {
        $BMI = 0;
        if( $this->weight > 0 and $this->height >0 ) 
        {
            $BMI = ($this->weight) / ( ($this->height/100)  **2);
        }
        return $BMI;
    }

    /**
     * Set headCircumference
     *
     * @param float $headCircumference
     *
     * @return ClinicExamConst
     */
    public function setHeadCircumference($headCircumference)
    {
        $this->headCircumference = $headCircumference;

        return $this;
    }

    /**
     * Get headCircumference
     *
     * @return float
     */
    public function getHeadCircumference()
    {
        return $this->headCircumference;
    }
}
