<?php
     require_once '../includes/header.inc.php';

     if(!empty($_SESSION)) {
             header('location:../index.php');
     }
     else {
        if (isset($_POST["signup"])) {
                $control = new UsersControl();
                $control->controlStudentInfo($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['address']);
        } 
     }

      
?>
<h1>Welcome to student internship dashboard</h1>
<p style="color:blue">please signup here</p>
<p id='session'><?php echo empty($_SESSION) ?   false: true;?></p>
<form action="Signup.php" method='POST' >
        <fieldset >
                <legend>Signup</legend>

                <p><input type="text" name="first_name" id="first_name" placeholder="first_name" required="required" class="mod1"></p>
                <p><input type="text" name="last_name" id="last_name" placeholder="last_name" required="required" class="mod1"></p>
                <p><input type="email" name="email" id="email" placeholder="Email" required="required" class="mod1"></p>
                <p><input type="password" name="password" id="pass1" placeholder="Student password" required="required" class="mod1"></p>
                <p><input type="password" name="password" id="pass2" placeholder="confirm password" required="required" class="mod1"></p>
                <p id="signupForm"><input type="text" name="address" id="address" placeholder="address" required="required" class="mod1"></p>

                <p><input type="submit" value="signup" name="signup" class='signup' id="signup"  onclick="return Validate()"></p>


        </fieldset>
</form>
<p style="color:green; padding-top: 2em;">please login if you have an account</p>
<a href="Login.php" class="btn btn-info">Login</a>


<?php require_once '../includes/footer.inc.php';?> 