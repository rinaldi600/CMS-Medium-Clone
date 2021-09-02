<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/views.css" rel="stylesheet">
    <script src="<?= base_url('ckeditor5/ckeditor.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('ckfinder/ckfinder.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url() ?>/js/jquery.js"></script>
    <title>CMS</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="identity-admin col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-6 col-3">
                <div class="row">
                    <div class="col-12 picture">
                        <img class="img-fluid rounded mx-auto d-block profile" src="/picture-profile/<?= $picture ?>" alt="">
                        <p class="text-center mt-2"><?= $usernameProfile ?></p>
                    </div>
                    <div class="menu col-12 d-grid justify-content-center align-content-start">
                        <div class="row">
                            <div class="col-12">

                            </div>
                            <div class="sign-out col-12 d-grid justify-content-center btn btn-outline-secondary">
                                <form action="/main/logout" method="post">
                                    <img src="<?= base_url() ?>/icons/logout.png" alt="">
                                    <button type="submit" onclick="return confirm('Do you want Log Out')"></button>
                                </form>
                            </div>
                            <div class="home-page col-12 mt-2 btn btn-outline-secondary">
                                <div>
                                    <img src="<?= base_url() ?>/icons/homepage.png" alt="">
                                    <a class="text-decoration-none text-dark" href="/home" target="_blank"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-9 col-md-9 col-sm-6 col-9 content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>

    </div>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/main.js"></script>
</body>
</html>
