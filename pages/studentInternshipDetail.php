<?php require_once '../includes/header.inc.php';
if (empty($_SESSION)) {
  header("location:Login.php");
} else {

  $view = new UsersView();
  $view->showstudentInternshipDetail();
}

?>
<?php require_once '../includes/footer.inc.php'; ?> 





    