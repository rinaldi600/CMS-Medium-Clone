<?= $this->extend('ForgotPassword/Template') ?>

<?= $this->section('content') ?>
<form action="/forgotPassword/verifyToken" method="post">
    <div class="mb-3">
        <div class="alert alert-success" role="alert">
            Token : <?= session()->get('token') ?>
            <div class="form-text">We'll never share your token with anyone else.</div>
        </div>
    </div>
    <div class="mb-3">
        <label for="token" class="form-label">Token</label>
        <input type="text" class="token form-control <?= session()->getFlashdata('errorMessage') ? 'is-invalid' : '' ?>" id="token" name="token" placeholder="Enter Token Here.." value="<?= old('token') ? old('token') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('errorMessage') ?>
        </div>
    </div>
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure')">Submit</button>
        <a class="btn btn-danger" href="/login">Back</a>
    </div>
</form>
<?= $this->endSection() ?>
