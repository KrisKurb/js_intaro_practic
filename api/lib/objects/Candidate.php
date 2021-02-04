<?php


class Candidate
{
    public $c_id;
    public $profession;
    public $city;
    public $photo;
    public $c_number;
    public $c_name;
    public $email;
    public $c_dr;
    public $salary;
    public $skills;
    public $me;
    public $status;
    public $age;

    // Get

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getCId()
    {
        return $this->c_id;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getCNumber()
    {
        return $this->c_number;
    }

    /**
     * @return mixed
     */
    public function getCName()
    {
        return $this->c_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getCDr()
    {
        return $this->c_dr;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->me;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    // Set

    /**
     * @param mixed $c_id
     */
    public function setCId($c_id)
    {
        $this->c_id = $c_id;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param mixed $c_number
     */
    public function setCNumber($c_number)
    {
        $this->c_number = $c_number;
    }

    /**
     * @param mixed $c_name
     */
    public function setCName($c_name)
    {
        $this->c_name = $c_name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $c_dr
     */
    public function setCDr($c_dr)
    {
        $this->c_dr = $c_dr;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @param mixed $me
     */
    public function setMe($me)
    {
        $this->me = $me;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}