<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container">

    <div class="w-50 mx-auto">
        <div class="w-100" style="padding-top:150px">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, sint quos sequi modi tempora sit iure beatae obcaecati quaerat, voluptate vero molestias, dicta omnis molestiae. Ducimus quod cum laudantium dolores.</p>
            <form method="post" action="<?= base_url('verifyEmail_logic/' . $userName) ?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Otp</label>
                    <input type="text" name="otp" class="form-control" id="exampleFormControlInput1" placeholder="code">
                </div>
                <div class="main-button">
                    <input class="sub-button" type="submit">
                    <a class="sub-button" href="<?= base_url('codeResent/' . $userName) ?>">Resent</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>