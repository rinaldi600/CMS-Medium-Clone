<?= $this->extend('Template/Views') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row post <?= session()->getFlashdata('successInsert') ? 'mt-3' : '' ?>">
            <form action="/main/postAdd" method="post">
                <?php if (session()->getFlashdata('successInsert')) { ?>
                    <div class="alert alert-success" role="alert">
                       <?= session()->getFlashdata('successInsert') ?>
                    </div>
                <?php } ?>
                <input type="hidden" class="form-control" name="idAuthor" value="<?= $idAuthor ?>">
                <input type="hidden" class="form-control" name="idContent" value="<?= $idContent ?>">
                <div class="col-12 mb-3 mt-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control <?= session()->getFlashdata('title') ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ? old('title') : '' ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= session()->getFlashdata('title') ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="mb-3" for="editor1">Content</label>
                    <textarea name="description" class="ck <?= session()->getFlashdata('description') ? 'is-invalid' : '' ?>" id="editor1" cols="30" rows="10">
                        <?= old('description') ? old('description') : '' ?>
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
                        <button type="submit" onclick="return confirm('Do you submit this post ?')"></button>
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
