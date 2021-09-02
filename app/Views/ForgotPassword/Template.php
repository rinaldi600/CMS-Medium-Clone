<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/forgot.css" rel="stylesheet">

    <title>Forgot Password</title>
</head>
<body>


    <div class="container">
        <div class="form position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <div class="cover-image col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">

                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 d-grid align-items-center">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

<script src="<?= base_url() ?>/js/forgot.js"></script>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
