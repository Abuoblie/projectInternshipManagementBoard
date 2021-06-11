<?php
 require_once '../includes//header.inc.php';
 if(!empty($_SESSION)) {
        header("location: ../index.php");
        
 }
 else{ 
         if (isset($_POST['submit'])) {
                $control = new UsersControl();
                $control->login($_POST['email'],$_POST['paswd']);
        }
}

?>

<section>
     

        <form action="login.php" method="POST">
                <fieldset>
                        <legend>login</legend>
                        <p><input type="text" name="email" placeholder="email" required="required"></p>
                        <p><input type="text" name="paswd" placeholder="paswd" required="required"></p>

                        <p><button type="submit" class="btn btn-primary" class="btn" name="submit">Sign in</button></p>
                </fieldset>
        </form>
</section>


<p style="color:green"><i>please click here to signup for a new account</i></p>
<a href="Signup.php?signup='ok'" class="btn btn-info">signup</a>
<?php require_once '../includes/footer.inc.php';?> 