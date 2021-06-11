<?php
require_once '../includes/header.inc.php';
if (empty($_SESSION)) {
        header("location:Login.php");
} else {
        if (isset($_POST["submit"])) {
                $control = new UsersControl();
                $control->applyForInternship($_POST['subject'], $_POST['supervisor'], $_SESSION['student_id'], $_POST['eid']);
        }
}
?>
<section>
        <form action="addInternship.php" method='POST'>
                <fieldset>
                        <legend>apply for internship</legend>

                        <p><input type="text" name="subject" id="subject" placeholder="subject" required="required" /></p>
                        <p><input type="text" name="supervisor" id="supervisor" placeholder="supervisor" required="required" /></p>
                        <input value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>" type="number" style="display:none" name="eid" id="eid">
                        <p><input type="submit" value="submit" name="submit" class="btn btn-primary" class="btn"  id="submit"></p>


                </fieldset>
        </form>
</section>
<?php require_once '../includes/footer.inc.php'; ?>