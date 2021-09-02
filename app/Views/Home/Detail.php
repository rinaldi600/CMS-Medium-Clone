<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>/css/detail.css">

    <title><?= $detailContent[0]["title"] ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid position-relative">
        <div class="profile d-flex align-items-center gap-4 flex-wrap mb-2">
            <div class="username">
                <a class="text-decoration-none text-dark logo" href="#"><?= $detailContent[0]["username"] ?></a>
            </div>
            <div class="followers">
                <a class="text-decoration-none" href="#">1.6K Followers</a>
            </div>
            <div class="about">
                <a class="text-decoration-none" href="#">About</a>
            </div>
            <div class="follow">
                <a class="btn text-white rounded-pill" href="#">Follow</a>
            </div>
            <div class="message btn btn-outline-secondary">
                <img src="<?= base_url() ?>/icons/mail.png" alt="">
                <a class="text-dark text-decoration-none rounded-3" href="#"></a>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="menu-link navbar-nav">
                <li class="nav-item sign-in">
                    <a class="nav-link active text-success" aria-current="page" href="#">Sign In</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="started nav-link btn btn-outline-success rounded-pill" href="#">Get Started</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>
    <div class="container mx-auto">
        <div class="alert alert-secondary text-center mt-5" role="alert">
            You have 1 free member-only story left this month. <a class="text-dark text-decoration-underline" href="#">Sign up for Medium and get an extra one</a>
        </div>
        <div class="detail-content mt-5">
            <div class="title">
                <h1><?= $detailContent[0]["title"] ?></h1>
                <div class="profile-writer d-flex gap-2">
                    <img class="picture-username" src="<?= base_url() ?>/picture-profile/<?= $detailContent[0]["picture"] ?>" alt="">
                    <p class="username-text"><?= $detailContent[0]["username"] ?></p>
                    <p class="detail-date"><?= date('j M',strtotime($detailContent[0]["created_at"])) ?> · <?= rand(1,5) ?> min read</p>
                </div>
            </div>
        </div>
        <div class="story-content p-2">
            <?= $detailContent[0]["deskripsi"] ?>
        </div>
    </div>
</main>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/detail.js"></script>
</body>
</html>
