<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container" style="padding-top:150px">
    <div class="row">
        <?php if (session()->getFlashdata('mass')) : ?>
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('mass') ?>
                </div>
            </div>
        <?php elseif (session()->getFlashdata('Errmass')) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('Errmass') ?>
                </div>
            </div>
        <?php endif ?>
        <div class="col-md-3 ">
            <img class="w-75 rounded-circle" src="<?= base_url($data[0]['profilePicture'] == null ? 'assets/images/dummy450x450.jpg' : 'images/' . $userName . '/profile/' . $data[0]['profilePicture']) ?>" alt="">
            <?php if (other($userName)) : ?>
                <form class="mt-3" method="post" action="<?= base_url('profilePic/' . $userName) ?>" enctype="multipart/form-data">
                    <div class="input-group mb-3">

                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Upload</label>
                            <input name="profilePicture" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        </div>
                    </div>
                    <input class="sub-button" type="submit" value="submit">
                </form>
            <?php endif; ?>
            <div class="list-group mt-5">
                <a href="<?= base_url('profile/' . $userName . "/timeline") ?>" class="list-group-item list-group-item-action <?= isset($optionName) ? ($optionName === "timeline" ? "active" : "") : "active" ?> ">Timeline</a>
                <a href="<?= base_url('profile/' . $userName . "/details") ?>" class="list-group-item list-group-item-action <?= isset($optionName) ? ($optionName === "details" ? "active" : "") : "" ?>">Details</a>
                <?php if (other($userName)) : ?>
                    <a href="<?= base_url('profile/' . $userName . "/setting") ?>" class="list-group-item list-group-item-action  <?= isset($optionName) ? ($optionName === "setting" ? "active" : "") : "" ?>">Settings</a>
                    <a href="<?= base_url('logout') ?>" class="list-group-item list-group-item-action">Loge out</a>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">

                <?php if (isset($optionName)) {
                    if ($optionName === "timeline") {
                        echo $this->include('./components/timeline_profile.php');
                    } else if ($optionName === "details") {
                        echo $this->include('./components/details_profile.php');
                    } else if ($optionName === "setting") {
                        echo $this->include('./components/setting.php');
                    }
                } else {
                    echo $this->include('./components/timeline_profile.php');
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>