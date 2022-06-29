<?php
include "func/init.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@200&display=swap" rel="stylesheet">
    <title>ITEC QUIZ</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex" href="index.php">
                <img class="navLogo me-2 d-inline-block" src="images/web_designs/penguin.png" alt="">
                <p class="mb-0 mt-1">ITEC QUIZ<p>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item activeNavItem px-2">
                        <a class="nav-link text-white" aria-current="page" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <a class="nav-link ms-lg-0 ms-md-2" href="about.php"><i class="fa fa-info" aria-hidden="true"></i> About<span
                            class="sr-only"></span></a>
                    </li>
                    <?php if($_SESSION['logged_in'] == true): ?>
                    </li>
                    <a class="nav-link ms-lg-0 ms-md-2" href="user.php"><i class="fa fa-user-circle" aria-hidden="true"></i>
                        <?= $_SESSION['username'];?><span class="sr-only">(current)</span></a>
                    </li>
                    </li>
                    <a class="nav-link ms-lg-0 ms-md-2" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                    </li>
                    <?php else: ?>
                    </li>
                    <a class="nav-link ms-lg-0 ms-md-2" href="login.php"><i class="fa fa-user" aria-hidden="true"></i> Login<span
                            class="sr-only">(current)</span></a>
                    </li>
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav> <!-- End of navbar -->
