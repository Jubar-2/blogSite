<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="w-50 mx-auto" style="padding-top:150px">
        <?php if (session()->getFlashdata('Errmass')) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('Errmass') ?>
                </div>
            </div>
        <?php endif ?>
        <form method="post" action="<?= base_url('login_logic') ?>">
            <!-- Email input -->
            <div class=" form-outline mb-4">
                <input type="text" id="form2Example1" class="form-control" name="userAddress" />
                <label class="form-label" for="form2Example1">Email / User Name</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" name="password" class="form-control" />
                <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a class="text-orang" href="<?= base_url('forgetPassword') ?>">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->

            <input type="submit" class="btn oreng btn-block mb-4" value="Sign in">

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a class="text-orang" href="<?= base_url('registration') ?>">Register</a></p>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>