<?php

class UsersView extends Users
{

        public function showWelcome()
        {
                if (!empty($_SESSION)) {
                        echo "<h2>Welcome {$_SESSION['first_name']} {$_SESSION['last_name']} to the dashboard</h2>";
                } else {
                        header("Location:/projectStage/pages/login.php");
                }
        }


        public function showStudentList()
        {
                echo "
                      <h1>Student list</h1>
                      <a href='studentList.php?ids=0' class='btn btn-info' style='margin-bottom : 0.5em;'>students without internships</a>
                      <a href='studentList.php?ids=1' class='btn btn-info'  style='margin-bottom : 0.5em;'>students with internships</a>  
                      <a href='studentList.php?ids=2' class='btn btn-info'  style='margin-bottom : 0.5em;'>All students</a>";

                if (isset($_GET['ids'])) {
                        if ($_GET['ids'] == 0) {
                                $result = $this->getStudents('indicator', '0');
                        } else if ($_GET['ids'] == 1) {
                                $result = $this->getStudents('indicator', '1');
                        } else {
                                $result = $this->getStudents(1, 1);
                        }
                } else {
                        $result = $this->getStudents(1, 1);
                }
                echo '
                    <table class="table">
                          <thead class="thead-dark">
                                <tr>
                                       <th scope="col">FirstName</th>
                                       <th scope="col">LastName</th>
                                       <th scope="col">Email</th>
                                       <th scope="col">status</th>
              
                               </tr>
                           </thead>
                           <tbody>
                
                ';

                foreach ($result as  $row) {
                        $student = $this->studentsWithInternship('email', $row['email']);
                        echo " <tr>
                               <td>{$row['first_name']}</td>
                               <td>{$row['last_name']}</td>
                              <td>{$row['email']}</td>";

                        if (!empty($student)) {
                                echo "<td><a href='studentInternshipDetail.php?id={$row['student_id']}' class='btn btn-info'>internships</a></td>";
                        }
                        else {
                                echo "<td>N/A</td>";
                        }
                        echo '</tr>';
                }

                echo '
                           </tbody>
                </table>';
        }


        public function showCompanies()
        {
                echo "
                <h2 style='margin-bottom : 1em;'>list of enterprises </h2>

                    <a href='companies.php?order=name' class='btn btn-info' style='margin-bottom : 1em;'>sort by name</a>
                    <a href='companies.php?order=location' class='btn btn-info' style='margin-bottom : 1em;'>sort by location</a>
                    <table class='table'>
                            <thead>
                                    <tr>
                                        <th scope='col'>name</th>
                                        <th scope='col'>Location</th>
                                        <th scope='col'>choice</th>    
                                    </tr>
                            </thead>
                            <tbody>               
                ";

                if (isset($_GET['order'])) {
                        $result = $this->getEnterprise($_GET['order']);
                } else {
                        $result = $this->getEnterprise('enterprise_id');
                }

                foreach ($result as  $row) {

                        echo "
                        <tr>
                          <td>{$row['name']}</td>
                          <td>{$row['location']}</td>
                          <td><a href='addInternship.php?id={$row['enterprise_id']}' class='btn btn-info'>select company for internship</a></td>
                         </tr>
                         ";
                }
                echo "
                    </tbody>
                </table>
                ";
        }


        public function showStudentInternships()
        {
                echo '<h1>selected internship</h1>';

                $result = $this->studentsWithInternship('s.student_id', $_SESSION['student_id']);

                echo "</br></br>
                  <h4 style='text-align:left;'>Student:{$result[0]['first_name']} {$result[0]['last_name']} </h4>
                  <h5 style='text-align:left;'>Email: {$result[0]['email']}</h5>
                  <h4 style='text-align:left;'>internships:</h4>";

                echo "</br></br>
                       
                       <div class='container-md'>
                          <table class='table'>";
                echo "         <thead class='thead-dark'>
                                      <tr>
                                              <th>Name of company</th>
                                              <th>Location</th>
                                              <th>Subject</th>
                                              <th>name of supervisor</th>
                                             
                                      </tr>
                                </thead>";


                foreach ($result as $row) {



                        echo " <tr>
                                      <td>{$row['name']}</td>
                                      <td>{$row['location']} </td>
                                      <td>{$row['subject']}</td>
                                      <td>{$row['supervisor']} </td>
                                   </tr>";
                }
                echo "    </table>
                      </div>";
        }


        public function showstudentInternshipDetail()
        {
                if (isset($_GET['id'])) {
                        echo '<h1>Detail</h1>';

                        $result = $this->studentsWithInternship('s.student_id', $_GET['id']);

                        echo "</br></br>
                          <h4 style='text-align:left;'>Student:{$result[0]['first_name']} {$result[0]['last_name']} </h4>
                          <h5 style='text-align:left;'>Email: {$result[0]['email']}</h5>
                          <h4 style='text-align:left;'>internships:</h4>";

                        echo '<a href="studentList.php" class="btn btn-info">back to student list</a>';

                        echo "</br></br>
                               
                               <div class='container-md'>
                                  <table class='table'>
                                        <thead>
                                              <tr>
                                                      <th>Name of company</th>
                                                      <th>Location</th>
                                                      <th>Subject</th>
                                                      <th>name of supervisor</th>
                                                     
                                              </tr>
                                      </thead>";


                        foreach ($result as $row) {



                                echo " <tr>
                                              <td>{$row['name']}</td>
                                              <td>{$row['location']} </td>
                                              <td>{$row['subject']}</td>
                                              <td>{$row['supervisor']} </td>
                                           </tr>";
                        }
                        echo "    </table>
                              </div>";
                } else {
                        header("location: index.php");
                }
        }
}
