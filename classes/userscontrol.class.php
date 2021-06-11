<?php


class UsersControl extends Users
{
        private function verifyInput($data)
        {
                // Delete space befor and after 
                $data = trim($data);
                // Delete backslashes
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return filter_var($data, FILTER_SANITIZE_STRING);
        }


        public function login($email, $password)
        {
                $logged = $this->getLogin($email, trim($password));

                if (empty($logged)) {


                        echo "<p style='text-align: center; color:red;'>invalid email or password please sign up if you don't have an account</p>";
                        //header("location: Signup.php");

                } else {

                        $_SESSION['email'] = $logged['email'];
                        $_SESSION['first_name'] = $logged['first_name'];
                        $_SESSION['last_name']  = $logged['last_name'];
                        $_SESSION['student_id']  = $logged['student_id'];


                        header("location:../index.php");
                }
        }


        public function controlStudentInfo($first_name, $last_name, $mail, $passwd, $address)
        {
                if (!empty($this->checkAccount($mail))) {
                        echo "this email is associated to an account please sign ";
                } else {

                        $firstName = null;
                        $lastName = null;
                        $pswd = null;
                        $email = null;
                        $adress = null;
                        $regex = "/^[\w.\s]+$/";
                        $regMail = "/^[A-Za-z]+[\w.][A-Za-z]+@[A-Za-z]+\.[A-Za-z]+$/";

                        if (strlen($first_name) > 1 && preg_match($regex, $first_name)) {
                                $firstName = $this->verifyInput($_POST['first_name']);
                        } else {
                                if (strlen($first_name) < 2) {
                                        echo "<p style='text-align: center; color:red;'>first name must be at least 2 characters</p>";
                                } else {
                                        echo "<p style='text-align: center; color:red;'>first name cannot contain special nor illicit characters</p>";
                                }
                        }
                        if (strlen($address) > 1 && preg_match("/[\w.\-]/", $address)) {
                                $adress = $this->verifyInput($address);
                        } else {
                                if (strlen($address) < 2) {
                                        echo "<p style='text-align: center; color:red;'>address must be at least 2 characters</p>";
                                } else {
                                        echo "<p style='text-align: center; color:red;'>address cannot contain special nor illicit characters</p>";
                                }
                        }

                        if (strlen($last_name) > 1 && preg_match($regex, $last_name)) {
                                $lastName = $this->verifyInput($last_name);
                        } else {
                                if (strlen($first_name) < 2) {
                                        echo "<p style='text-align: center; color:red;'>last name must be at least 2 characters</p>";
                                } else {
                                        echo "<p style='text-align: center; color:red;'>last name cannot contain special nor illicit characters</p>";
                                }
                        }

                        if (preg_match($regMail, trim($mail)) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                                $email = trim(filter_var($mail, FILTER_SANITIZE_EMAIL));
                        } else {
                                echo "<p style='text-align: center; color:red;'>email cannot contain the following characters {\&\"# \'\(^§!°¨%µ£~\:/)?,;=+´<> or space} </p>";
                        }
                        if (strlen($passwd) > 3) {
                                $pswd = trim($passwd);
                        } else {
                                echo "<p style='text-align: center; color:red;'>password must be at least 4 characters</p>";
                        }
                        if (empty($firstName) || empty($lastName) || empty($email) || empty($pswd) || empty($adress)) {
                                echo "<p style='text-align: center; color:red;'> account was not created please correct the mistakes and resubmit</p>";
                        } else {

                                $this->addStudent($firstName, $lastName, $email, $pswd, $adress);
                                echo "<p style='text-align: center; color:green;'> account successfully created</p>";
                                header('location:login.php');
                        }
                }
        }

        public function setEnterprise($name, $location)
        {

                $entStatus = $this->checkEnterprise('name', $name, 'location', $location);

                if (!empty($entStatus)) {
                        echo "<p style='text-align: center; color:red;'>enterprise exist! please choose another enterprise or check the enterprise list </p>";
                } else {
                        $enterpriseName = null;
                        $enterpriseLocation = null;
                        if (strlen($name) > 1) {
                                $enterpriseName = $this->verifyInput($name);
                        } else {
                                echo "<p style='text-align: center; color:green;'>company name must be at least 2 characters</p>";
                        }
                        if (strlen($location) > 2) {
                                $enterpriseLocation = $this->verifyInput($location);
                        } else {
                                echo "<p style='text-align: center; color:green;'>location must be at least 3 characters</p>";
                        }

                        if (empty($enterpriseName) || empty($enterpriseLocation)) {
                                echo "< style='text-align: center; color:red;'> addition failed! please correct the identified mistakes</p>";
                        } else {
                                $this->addEnterprise($enterpriseName, $enterpriseLocation);
                                header("Location:companies.php");
                        }
                }
        }


        public function applyForInternship($subject, $supervisor, $student_id, $enterprise_id)
        {
                $status = $this->getInternship('student_id', $student_id, 'enterprise_id', $enterprise_id);
                if (empty($status)) {
                        $subj = $this->verifyInput($subject);
                        $sup = $this->verifyInput($supervisor);
                        if ($subj > 1 && $sup > 2) {
                                $this->addInternship($sup, $subj, $student_id, $enterprise_id);
                                $this->updateStudent('s.student_id', $_SESSION['student_id']);
                                header("Location:companies.php");
                        } else {
                                echo "< style='text-align: center; color:red;'> procedure failed! you entered too few characters subject must be at least 2 characters and supervisor at least 3 </p>";
                        }
                } else {
                        echo "<p style='text-align: center; color:red;'> you've already applied for an internship with this company</p>";
                        echo "<a href='companies.php' class='btn btn-info' style='margin:1em;'>click here to go to back</a>";
                }
        }

        public function checkInternship($condition, $check)
        {
                $result = $this->studentsWithInternship($condition, $check);
                if (empty($result)) {
                        return false;
                }
                return true;
        }
}
