<?= $this->extend('ForgotPassword/Template') ?>

<?= $this->section('content') ?>
<form action="/forgotPassword/verifyEmail" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control <?= session()->getFlashdata('errorMessage') ? 'is-invalid' : '' ?>" id="exampleInputEmail1" name="email" placeholder="Enter Email Here.." value="<?= old('email') ? old('email') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('errorMessage') ?>
        </div>
    </div>
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="/login">Back</a>
    </div>
</form>
<?= $this->endSection() ?>
