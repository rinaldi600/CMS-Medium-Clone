<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/signup.css" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body>
<div class="signup-view">
    <div class="cover row position-absolute top-50 start-50 translate-middle mx-auto">
        <div class="bg-image col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">

        </div>
        <div class="form-signup col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 d-grid align-content-center">
            <?php if (session()->getFlashdata('success')) { ?>
                <div class="alert alert-success" role="alert">
                   <?= session()->getFlashdata('success') ?> <a class="text-decoration-none" href="<?= base_url() ?>">Login</a>
                </div>
            <?php } ?>
            <form method="post" action="signup/signup" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Enter Email Here..." name="email" value="<?= old('email') ? old('email') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('email') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Enter Username Here..." name="username" value="<?= old('username') ? old('username') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('username') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Enter Password Here..." name="password">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('password')?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control <?= session()->getFlashdata('confirmPassword') ? 'is-invalid' : '' ?>" id="passwordConfirm" placeholder="Enter Confirm Password Here..." name="confirmPassword">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('confirmPassword')?>
                    </div>
                </div>
                <div class="mb-3 preview">
                    <img src="/picture-profile/thumbnail.jpg" class="rounded float-start mx-auto preview-image" alt="Image Thumbnails">
                </div>
                <div class="mb-3 input-group">
                    <input type="file" class="form-control upload-file <?= session()->getFlashdata('picture') ? 'is-invalid' : '' ?>" id="inputGroupFile04" placeholder="Enter Image Here..." name="picture">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('picture')?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="create">Create</button>
                <a href="<?= base_url() ?>" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/signup.js"></script>
</body>
</html>
