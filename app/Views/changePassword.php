<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="w-50 mx-auto" style="padding-top:150px">
        <form method="post" action="<?= base_url('newPassword_logic/' . $userName) ?>">
            <!-- Email input -->
            <div class=" form-outline mb-4">
                <input type="password" id="form2Example1" class="form-control" name="password" />
                <label class="form-label" for="form2Example1">Password</label>
            </div>
            <div class=" form-outline mb-4">
                <input type="password" name="confirm_password" id="form2Example1" class="form-control" name="email" />
                <label class="form-label" for="form2Example1">Conforim Password</label>
            </div>
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" value="Sent">

        </form>
    </div>
</div>
<?= $this->endSection() ?>