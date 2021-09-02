<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/home.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<div class="nav-menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Medium Clone
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
            </button>
            <div class="coba collapse navbar-collapse" id="navbarNav">
                <div class="menu-link d-grid justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Membership</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Write</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>


<div class="header">
    <div class="main-one">
        <div class="row">
            <div class="col-6">
                <div class="text">
                    <h1 class="lh-sm">
                        Medium is a place <br>
                        to write, read, and <br>
                        connect
                    </h1>
                    <p class="mt-3">
                        It's easy and free to post your thinking on any topic and
                        connect with millions of readers.
                    </p>
                    <div class="button btn btn-outline-secondary bg-white rounded-pill p-2">
                        <a class="text-decoration-none text-dark" href="/login">Start Writing</a>
                    </div>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
</div>

<div class="main">
    <div class="row mt-5">
        <div class="content col-12">
            <div class="title d-flex gap-2 mb-3 mx-3">
                <div class="image-thumbnail-trending">
                    <img src="<?= base_url() ?>/icons/stat.png" alt="">
                </div>
                <div class="title-trending d-flex">
                    <h6>TRENDING ON MEDIUM</h6>
                </div>
            </div>
            <div class="content-news d-flex gap-4 flex-wrap justify-content-center">
                <?php $number = 1; ?>
                <?php foreach ($dataPublish as $data) { ?>
                    <?php if ($data["status"] === 'published') { ?>
                        <div class="news p-2">
                            <div class="row">
                                <div class="col-3 d-grid justify-content-center align-content-center">
                                    <?php if ($number < 10) { ?>
                                        <h3>0<?= $number++ ?></h3>
                                    <?php } else { ?>
                                        <h3><?= $number++ ?></h3>
                                    <?php } ?>
                                </div>
                                <div class="col-9">
                                    <div class="profile-picture d-flex gap-2">
                                        <div class="thumb-profile">
                                            <img src="<?= base_url() ?>/picture-profile/<?= $data["picture"] ?>" alt="">
                                        </div>
                                        <p><?= $data["username"] ?></p>
                                    </div>
                                    <div class="title-news">
                                        <a class="text-decoration-none text-dark" href="/home/detail/<?= $data["idContent"] ?>">
                                            <h2><?= $data["title"] ?></h2>
                                        </a>
                                    </div>
                                    <div class="date-news">
                                        <p><?= date("D M j", strtotime($data["created_at"])) ?> · <?= rand(1,5) ?> min read</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
