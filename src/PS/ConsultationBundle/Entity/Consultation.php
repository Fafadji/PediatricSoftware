<?php

namespace PS\ConsultationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PS\CustomerBundle\Entity\Patient;

/**
 * Consultation
 *
 * @ORM\Table(name="ps_consultation")
 * @ORM\Entity(repositoryClass="PS\ConsultationBundle\Repository\ConsultationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Consultation
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
     * @ORM\ManyToOne(targetEntity="PS\CustomerBundle\Entity\Patient", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $patient;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="interview", type="text", nullable=true)
     */
    private $interview;

    /**
     * @var string
     *
     * @ORM\Column(name="clinicExamination", type="text", nullable=true)
     */
    private $clinicExamination;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusion", type="text", nullable=true)
     */
    private $conclusion;

    /**
     * @var string
     *
     * @ORM\Column(name="checkup", type="text", nullable=true)
     */
    private $checkup;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnosis", type="text", nullable=true)
     */
    private $diagnosis;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text", nullable=true)
     */
    private $treatment;
    
    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;
    
     /**
     * @var int
     *
     * @ORM\Column(name="height", type="float", nullable=true)
     */
    private $height;
    
     /**
     * @var int
     *
     * @ORM\Column(name="temperature", type="float", nullable=true)
     */
    private $temperature;
    
     /**
     * @var string
     *
     * @ORM\Column(name="bloodPressure", type="text", nullable=true)
     */
    private $bloodPressure;

    
    public function __construct(Patient $patient)
    {
      $this->setPatient($patient);
      $this->setDate(new \Datetime());
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Consultation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set interview
     *
     * @param string $interview
     *
     * @return Consultation
     */
    public function setInterview($interview)
    {
        $this->interview = $interview;

        return $this;
    }

    /**
     * Get interview
     *
     * @return string
     */
    public function getInterview()
    {
        return $this->interview;
    }

    /**
     * Set clinicExamination
     *
     * @param string $clinicExamination
     *
     * @return Consultation
     */
    public function setClinicExamination($clinicExamination)
    {
        $this->clinicExamination = $clinicExamination;

        return $this;
    }

    /**
     * Get clinicExamination
     *
     * @return string
     */
    public function getClinicExamination()
    {
        return $this->clinicExamination;
    }

    /**
     * Set conclusion
     *
     * @param string $conclusion
     *
     * @return Consultation
     */
    public function setConclusion($conclusion)
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    /**
     * Get conclusion
     *
     * @return string
     */
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * Set checkup
     *
     * @param string $checkup
     *
     * @return Consultation
     */
    public function setCheckup($checkup)
    {
        $this->checkup = $checkup;

        return $this;
    }

    /**
     * Get checkup
     *
     * @return string
     */
    public function getCheckup()
    {
        return $this->checkup;
    }

    /**
     * Set diagnosis
     *
     * @param string $diagnosis
     *
     * @return Consultation
     */
    public function setDiagnosis($diagnosis)
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    /**
     * Get diagnosis
     *
     * @return string
     */
    public function getDiagnosis()
    {
        return $this->diagnosis;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     *
     * @return Consultation
     */
    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;

        return $this;
    }

    /**
     * Get treatment
     *
     * @return string
     */
    public function getTreatment()
    {
        return $this->treatment;
    }



    /**
     * Set patient
     *
     * @param \PS\CustomerBundle\Entity\Patient $patient
     *
     * @return Consultation
     */
    public function setPatient(\PS\CustomerBundle\Entity\Patient $patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \PS\CustomerBundle\Entity\Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Consultation
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Consultation
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set temperature
     *
     * @param integer $temperature
     *
     * @return Consultation
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return integer
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
     * @return Consultation
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
     * @return integer
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
}
