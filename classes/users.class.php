<?php 
require_once 'dbh.class.php';
Abstract class Users extends Dbh{ 
         

        protected function checkAccount($email)
        {
                $sql = "SELECT * FROM student where email= ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$email]);
                $login =  $stmt->fetch();

                return $login;
                $this->pdo = null;
        }

        protected function checkEnterprise($check,$condition,$check1,$condition1)
        {
                $sql = "SELECT * FROM enterprise where $check =? and $check1=?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$condition,$condition1]);
                $result = $stmt->fetchAll();
                return $result;
                $this->pdo = null;

                
        }


        protected function getLogin($email, $password)
        {
                $sql = "SELECT * FROM student where email= ? and pswd = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$email, $password]);
                $login =  $stmt->fetch();

                return $login;
                $this->pdo = null;
        }

        protected function getStudents($check,$condition)
       {
                $sql = "SELECT * FROM student where $check= ? ORDER by last_name, first_name";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$condition]);
                $result = $stmt->fetchAll();
                return $result;
                $this->pdo = null;
       }

       protected function getEnterprise($order)
       {
                $sql = "SELECT * FROM enterprise ORDER BY $order Asc";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
                $this->pdo = null;
       }
       
        protected function getInternship($check1, $condition1,$check2, $condition2,){ 
                $sql = "SELECT * FROM internship i where  $check1=? and $check2=? ";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$condition1,$condition2]);
                $result = $stmt->fetchAll();
                return $result;
                $this->pdo = null;

        }

       protected function studentsWithInternship($condition, $check){

                $sql = "SELECT * FROM student as s join internship i on s.student_id = i.student_id join enterprise e on e.enterprise_id = i.enterprise_id where $condition =?  ";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$check]);
                $result = $stmt->fetchAll();
                return $result;
                $this->pdo = null;

       }

       protected function addEnterprise($name, $location)
       {
               $sql = "INSERT INTO enterprise(name , location)values(?,?)";
               $stmt = $this->connect()->prepare($sql);
               $stmt->execute([$name, $location]);
               $this->pdo = null;

       }

       protected function addStudent($first_name, $last_name, $email, $pswd, $address) //order by id desc limit 5
        {
                $sql = "INSERT INTO student(first_name, last_name, email, pswd, address, indicator)
                               values(?,?,?,?,?,0)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$first_name, $last_name, $email, $pswd, $address]);
                $this->pdo = null;
        }

        protected function addInternship($supervisor, $subject, $student_id, $enterprise_id)
        {
                $sql = "INSERT INTO internship(supervisor, subject, student_id, enterprise_id)
                               values(?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$supervisor, $subject, $student_id, $enterprise_id]);
                $this->pdo = null;
        }

        protected function updateStudent($condition, $check){
                $log = $this->studentsWithInternship($condition, $check);
                if(empty($log)){

                        echo "student internship indicator was not updated";
                      
                }
                else {
                       $sql = "UPDATE student as s SET indicator = 1 where $condition = ?";
                       $stmt = $this->connect()->prepare($sql);
                       $stmt->execute([$check]);
                }
        }

}