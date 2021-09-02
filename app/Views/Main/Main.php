<?= $this->extend('Template/Views') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row main">
        <div class="col-12">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Data" name="keyword">
                    <div class="search btn btn-outline-secondary">
                        <img src="<?= base_url() ?>/icons/search.png" alt="">
                        <button type="submit" id="button-addon2"></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="menu-link mb-3 mt-3 d-flex gap-2">
                <div class="add-post btn btn-outline-secondary">
                    <img src="<?= base_url() ?>/icons/add.png" alt="">
                    <a href="/main/add"></a>
                </div>
                <div class="home btn btn-outline-secondary">
                    <img src="<?= base_url() ?>/icons/home.png" alt="">
                    <a href="/main"></a>
                </div>
            </div>
            <div class="mt-3">
                <div class="table-responsive">
                    <?php if (count($users) === 0) { ?>
                        <div class="data-not-found alert alert-danger" role="alert">
                            Data Not Found
                        </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('deleteAlert')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('deleteAlert') ?>
                        </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('publishAlert')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('publishAlert') ?>
                        </div>
                    <?php } ?>
                    <?php if (session()->getFlashdata('cancelPublishAlert')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('cancelPublishAlert') ?>
                        </div>
                    <?php } ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Content</th>
                            <th scope="col">Title</th>
                            <th scope="col">ID Author</th>
                            <th scope="col">Action</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $x) { ?>
                            <tr>
                                <th scope="row"><?= $number++ ?></th>
                                <td><?= $x["idContent"] ?></td>
                                <td><?= $x["title"] ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <div class="detail-id btn btn-outline-secondary" data-value="<?= $x["idAuthor"] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="<?= base_url() ?>/icons/detail.png" alt="">
                                        <?= $x["idAuthor"] ?>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?= $x["idAuthor"] ?></h5>
                                                </div>
                                                <div class="modal-body mx-auto">

                                                </div>
                                                <div class="modal-footer">
                                                    <div class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-flex d-grid gap-2 align-content-center">
                                    <div class="update btn btn-outline-secondary">
                                        <form action="/main/update" method="get">
                                            <img src="<?= base_url() ?>/icons/update.png" alt="">
                                            <input type="hidden" name="idContent" value="<?= $x["idContent"] ?>">
                                            <button type="submit"></button>
                                        </form>
                                    </div>
                                    <div class="delete btn btn-outline-secondary">
                                        <form action="/main/delete" method="post">
                                            <img src="<?= base_url() ?>/icons/delete.png" alt="">
                                            <input type="hidden" name="idContent" value="<?= $x["idContent"] ?>">
                                            <button type="submit" onclick="return confirm('do you want to delete this post?')"></button>
                                        </form>
                                    </div>
                                    <div class="preview btn btn-outline-secondary">
                                        <img src="<?= base_url() ?>/icons/preview.png" alt="">
                                        <a href="/main/preview/<?= $x["idContent"] ?>"></a>
                                    </div>
                                </td>
                                <?php if ($x["status"] === 'not_published') { ?>
                                    <td>
                                        <div class="publish btn btn-outline-secondary">
                                            <form action="/main/publish" method="post">
                                                <img src="<?= base_url() ?>/icons/paper-plane.png" alt="">
                                                <input type="hidden" name="idContent" value="<?= $x["idContent"] ?>">
                                                <button type="submit" onclick="return confirm('Do you want publish to blog ? ')"></button>
                                            </form>
                                        </div>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <div class="cancel-publish btn btn-outline-secondary">
                                            <form action="/main/cancelPublish" method="post">
                                                <img src="<?= base_url() ?>/icons/cancel-button.png" alt="">
                                                <input type="hidden" name="idContent" value="<?= $x["idContent"] ?>">
                                                <button type="submit" onclick="return confirm('Do you want cancel publish to blog ? ')"></button>
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3 text-center">
                <?= $pager->links('content', 'custom_pagination') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
