<?= $this->extend('Template/Views') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row post">
        <form action="/main/updateData" method="post">
            <?php if (session()->getFlashdata('updateMessage')) { ?>
                <div class="alert alert-success mt-3" role="alert">
                   <?= session()->getFlashdata('updateMessage') ?>
                </div>
            <?php } ?>
            <input type="hidden" class="form-control" name="idAuthor" value="<?= old('idAuthor') ? old('idAuthor') : $contentUpdate['idAuthor'] ?>">
            <input type="hidden" class="form-control" name="idContent" value="<?= old('idContent') ? old('idContent') : $contentUpdate['idContent'] ?>">
            <input type="hidden" class="form-control" name="status" value="<?= old('status') ? old('status') : $contentUpdate['status'] ?>">
            <div class="col-12 mb-3 mt-3">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('title') ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ? old('title') : $contentUpdate['title'] ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('title') ?>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <label class="mb-3" for="editor1">Content</label>
                <textarea name="description" class="ck <?= session()->getFlashdata('description') ? 'is-invalid' : '' ?>" id="editor1" cols="30" rows="10">
                        <?= old('description') ? old('description') : $contentUpdate['deskripsi'] ?>
                    </textarea>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('description') ?>
                </div>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor1' ), {
                            ckfinder: {
                                uploadUrl: "<?= base_url() ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json",
                            }
                        } )
                        .then( editor => {
                            console.log( editor );
                        } )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
            </div>
            <div class="col-12 mb-3 d-flex gap-2">
                <div class="submit-button btn btn-outline-secondary">
                    <img src="<?= base_url() ?>/icons/file-submit.png" alt="">
                    <button type="submit" onclick="return confirm('Do you update this post ?')"></button>
                </div>
                <div class="button-back btn btn-outline-secondary">
                    <img src="<?= base_url() ?>/icons/back.png" alt="">
                    <a href="/main"></a>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
