<?php
require_once '../includes/header.inc.php';
if (empty($_SESSION)) {
        header("location:Login.php");
} else {
        if (isset($_POST["addCompany"])) {
                $control = new UsersControl();
                $control->setEnterprise($_POST['name'], $_POST['location']);
        }
}

?>
<section>
        <form action="addCompany.php" method='POST'>
                <fieldset>
                        <legend>company</legend>

                        <p><input type="text" name="name" id="name" placeholder="enterprise" required="required" /></p>
                        <select name="location" id="location">
                                
                        </select>
                        <input type="submit" value="addCompany" name="addCompany" class="btn btn-primary" class="btn"  id="addCompany" />


                </fieldset>
        </form>
</section>

<?php require_once '../includes/footer.inc.php'; ?>