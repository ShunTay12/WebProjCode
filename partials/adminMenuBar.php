<?php include('../config/constants.php'); ?>

<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../node_modules/fontawesome-free-6.5.1-web/css/all.css">
<link rel="stylesheet" href="../node_modules/adminStyle.css">

<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../node_modules/popper.min.js"></script>
<script src="../node_modules/script.js"></script>


<div class="navigation mb-4">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark mb-5 bg-danger bg-gradient bg-opacity-75">
        <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse text-white ms-5 ps-5" id="navbarNav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link active" aria-current="page" href="adminViewKiosk.php">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">User Lists</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item ms-3 me-5">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
            <a href="../loginWebsite/staff_page.php" class="login me-3">
                <button type="button" class="btn btn-success p-2">
                    <i class="fa-regular fa-user"></i>
                    Admin
                </button>
            </a>                            
        </div>
    </nav> 
</div>

