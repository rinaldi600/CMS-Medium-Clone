<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/login.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div class="login-view">
        <div class="cover row position-absolute top-50 start-50 translate-middle mx-auto">
            <div class="bg-image col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">

            </div>
            <div class="form-login col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 d-grid align-content-center">
                <form method="post" action="login/signin">
                    <?php if (session()->getFlashdata('notFound')) { ?>
                        <div class="alert alert-danger" role="alert">
                           <?= session()->getFlashdata('notFound') ?>
                        </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('wrongPassword')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('wrongPassword') ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Enter Username Here..." value="<?= old('username') ? old('username') : '' ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= session()->getFlashdata('username') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter Password Here...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= session()->getFlashdata('password') ?>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="Check1" name="check">
                        <label class="form-check-label" for="Check1">Remember Me</label>
                    </div>
                    <div class="mb-3 d-grid justify-content-center">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                    <div class="mt-3 d-grid justify-content-center">
                        <a class="btn btn-success" href="/signup">Create Account</a>
                    </div>
                    <div class="mt-3 d-grid justify-content-center">
                        <a class="text-decoration-none" href="/forgotPassword">Forgot Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/signin.js"></script>
</body>
</html>