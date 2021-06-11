<?php
session_start();
require_once 'class.autoloader.inc.php';
$studentHasAnInternship = false;
if (!empty($_SESSION)) {

        $control = new UsersControl();
        $studentHasAnInternship = $control->checkInternship('email', $_SESSION['email']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

        <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
                <link rel="stylesheet" type="text/css" href="../assets/SCSS/style.css">
                <title>student internship</title>



        </head>
</head>

<body>
        <p id='page' style='display: none'><?php echo basename(($_SERVER['PHP_SELF'])) ?></p>
        <header>
                <ul class="nav justify-content-center">

                        <?php if (!empty($_SESSION)) { ?>

                                <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                                </li>


                                <li class="nav-item">
                                        <a class="nav-link" href="studentList.php">students list</a>
                                </li>

                                <?php if ($studentHasAnInternship) { ?>
                                        <li class="nav-item">
                                                <a href="infoInternship.php" class="nav-link">selected internship</a>
                                        </li><?php } ?>

                                <li class="nav-item">
                                        <a class="nav-link" href="companies.php">list of companies</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="addCompany.php">addCompany</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="logout.php">logout</a>
                                </li> <?php } ?>
                        <li class="nav-item">


                </ul>

        </header>