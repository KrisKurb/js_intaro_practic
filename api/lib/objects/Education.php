<?php
class Education
{
    public $ed_id;
    public $c_id;
    public $level;
    public $university;
    public $faculty;
    public $specialization;
    public $ed_year;

    /**
     * @return mixed
     */
    public function getCId()
    {
        return $this->c_id;
    }

    /**
     * @param mixed $c_id
     */
    public function setCId($c_id)
    {
        $this->c_id = $c_id;
    }

    /**
     * @return mixed
     */
    public function getSpecialization()
    {
        return $this->specialization;
    }

    /**
     * @param mixed $specialization
     */
    public function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * @param mixed $university
     */
    public function setUniversity($university)
    {
        $this->university = $university;
    }

    /**
     * @return mixed
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * @param mixed $ed_year
     */
    public function setEdYear($ed_year)
    {
        $this->ed_year = $ed_year;
    }

    /**
     * @return mixed
     */
    public function getEdYear()
    {
        return $this->ed_year;
    }

    /**
     * @param mixed $faculty
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * @return mixed
     */
    public function getEdId()
    {
        return $this->ed_id;
    }

    /**
     * @param mixed $ed_id
     */
    public function setEdId($ed_id)
    {
        $this->ed_id = $ed_id;
    }
}