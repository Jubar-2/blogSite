<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="w-50 mx-auto" style="padding-top:150px">
        <form method="post" action="<?= base_url('fogetPassword_logic') ?>">
            <!-- Email input -->
            <div class=" form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control" name="email" />
                <label class="form-label" for="form2Example1">Email</label>
            </div>
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" value="Sent">

        </form>
    </div>
</div>
<?= $this->endSection() ?>