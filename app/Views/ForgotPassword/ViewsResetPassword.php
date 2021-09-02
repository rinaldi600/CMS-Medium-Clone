<?= $this->extend('ForgotPassword/Template') ?>

<?= $this->section('content') ?>
<form action="/forgotPassword/verifyPassword" method="post">
    <?php if (session()->getFlashdata('successMessage')) { ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('successMessage') ?> <a href="/">Login</a>
        </div>
    <?php } ?>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter Password Here..">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('password') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="ConfirmPassword" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control <?= session()->getFlashdata('confirmPassword') ? 'is-invalid' : '' ?>" id="ConfirmPassword" name="confirmPassword" placeholder="Enter Confirm Password Here..">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('confirmPassword') ?>
        </div>
    </div>
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Do you sure change password')">Submit</button>
        <a class="btn btn-danger" href="/">Back</a>
    </div>
</form>
<?= $this->endSection() ?>
