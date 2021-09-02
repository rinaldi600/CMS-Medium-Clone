<?= $this->extend('Template/Views') ?>

<?= $this->section('content') ?>
<div class="nav-link">
    <div class="button-back btn btn-outline-secondary">
        <img src="<?= base_url() ?>/icons/back.png" alt="">
        <a class="text-decoration-none" href="/main"></a>
    </div>
</div>
<div class="content-description container">
    <h1 class="title"><?= $title ?></h1>
    <?= $deskripsi ?>
</div>
<?= $this->endSection() ?>
