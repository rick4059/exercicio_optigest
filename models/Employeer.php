<?php
namespace Models;

require '../config/db_connect.php';

class Employeer{
    private $id;
    private $name;
    private $age;
    private $job;
    private $salary;
    private $admission_date;

    private $conn = $conn;

    //Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getJob() {
        return $this->job;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function getAdmissionDate() {
        return $this->admission_date;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setJob($job) {
        $this->job = $job;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function setAdmissionDate($admission_date) {
        $this->admission_date = $admission_date;
    }


    public function getIdadeMedia(){
        $query = "SELECT * FROM employees";

        $stmt = $conn->prepare($sql);
        $stmt->execute();


    }
}