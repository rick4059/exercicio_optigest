<?php
namespace Models;

class Employeer{
    private $id;
    private $name;
    private $age;
    private $job;
    private $salary;
    private $admission_date;

    public function __construct($conn) {
        $this->conn = $conn;
    }

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
        $sql = "SELECT AVG(age) AS media_idade FROM employees";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $row['media_idade'] ?? 0;
    }

    public function salaryGrow($percent){
        if($percent < 0 || empty(trim($percent))){
            return [];
        }

        $output = [];

        $sql = "SELECT id, name, salary FROM employees";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $salarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($salarios as $salario) {
            if(empty($salario)){
                $output[$salario['id']] = 0;
            }else{
                $output[$salario['id']] = $salario['salary'] + $salario['salary']*$percent/100;
            }
        }

        return $output;
    }

    public function getJobs(){
        $output = [];

        $sql = "SELECT id, job FROM employees";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($jobs as $job) {    
            $output[$job['id']] = $job['job'];
        }

        return $output;
    }

    public function getThisYearFinishedProjects(){
        $sql = "SELECT id, description, value, status, delivery_date FROM projects
        WHERE YEAR(delivery_date) = YEAR(CURDATE()) AND status = 'finished' 
        ORDER BY value DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $jobs;
    }

    public function getNextProjects($data_ini, $data_fim){
        $sql = "SELECT GROUP_CONCAT(p.id) as id, GROUP_CONCAT(p.description) as description, GROUP_CONCAT(p.value) as value, GROUP_CONCAT(p.status) as status, GROUP_CONCAT(p.delivery_date) as delivery_date  
        FROM projects p
        INNER JOIN employees e ON e.id = p.id_employee
        WHERE p.delivery_date BETWEEN :data_ini AND :data_fim
        AND p.status != 'finished'
        GROUP BY e.id
        ORDER BY p.delivery_date ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':data_ini', $data_ini);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->execute();
        $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $jobs;
    }
}